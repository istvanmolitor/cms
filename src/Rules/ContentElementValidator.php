<?php

declare(strict_types=1);

namespace Molitor\Cms\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Molitor\Cms\Services\ContentHandler;

class ContentElementValidator implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $attribute: content.content_elements.0.content
        // We need the type of this element.
        $index = $this->getIndexFromAttribute($attribute);
        if ($index === null) {
            return;
        }

        $typePath = "content.content_elements.{$index}.type";
        $type = data_get($this->data, $typePath);

        if (! $type) {
            return;
        }

        /** @var ContentHandler $handler */
        $handler = app(ContentHandler::class);
        $elementType = $handler->getElementType($type);

        if (! $elementType) {
            $fail(__('The selected content element type is invalid.'));

            return;
        }

        $rules = $elementType->getValidationRules();

        $validator = Validator::make($value, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $fail($message);
            }
        }
    }

    protected function getIndexFromAttribute(string $attribute): ?string
    {
        // Example: content.content_elements.0.content
        if (preg_match('/content\.content_elements\.(\d+)\.content/', $attribute, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
