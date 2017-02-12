<?php
namespace EkAndreas\Listig\Language;

class Script
{
    public static function translations()
    {
        return [
            'settingsLabel' => __('Settings'),
            'newListLabel' => __('New list', 'listig'),
            'editLabel' => __('Edit list properties', 'listig'),
            'saveLabel' => __('Save'),
            'cancelLabel' => __('Cancel'),
            'nameLabel' => __('Name'),
            'namePlaceholder' => __('Please, enter a name!', 'listig'),
            'descriptionLabel' => __('Description'),
            'descriptionPlaceholder' => __('Tell a story about this list and it´s purpose!', 'listig'),
            'privateLabel' => __('Private (only you can see and edit this list)', 'listig'),
            'destroyLabel' => __('Delete list', 'listig'),
            'helpTitle' => __('help','listig'),
            'settingsTitle' => __('settings','listig'),
        ];
    }
}
