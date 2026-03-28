<?php

namespace Molitor\Cms\Models;

use Molitor\Language\Models\TranslationModel;

class MenuItemTranslation extends TranslationModel
{
    public function getTranslatableModelClass(): string
    {
        return MenuItem::class;
    }

    public function getTranslationForeignKey(): string
    {
        return 'menu_item_id';
    }

    public function getTranslatableFields(): array
    {
        return [
            'label',
            'url',
        ];
    }
}
