<?php

declare(strict_types=1);

namespace Molitor\Cms\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Molitor\Cms\Exceptions\InvalidElementTypeNameException;
use Molitor\Cms\Services\ContentHandler;

class ContentElementValidator implements DataAwareRule, ValidationRule, ValidatorAwareRule
{
    /**
     * @var array<string, mixed>
     */
    protected array $data = [];

    protected ValidatorInstance $validator;

    /**
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function setValidator(ValidatorInstance $validator): static
    {
        $this->validator = $validator;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $attribute: content.content_elements.0.settings
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

        try {
            $elementType = $handler->getElementType($type);
        } catch (InvalidElementTypeNameException) {
            $fail(__('The selected content element type is invalid.'));

            return;
        }

        $rules = $elementType->getValidationRules();
        $subValidator = Validator::make($value, $rules);

        if ($subValidator->fails()) {
            foreach ($subValidator->errors()->messages() as $field => $messages) {
                foreach ($messages as $message) {
                    $this->validator->errors()->add("{$attribute}.{$field}", $message);
                }
            }
        }
    }

    protected function getIndexFromAttribute(string $attribute): ?string
    {
        if (preg_match('/content\.content_elements\.(\d+)\.settings/', $attribute, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
