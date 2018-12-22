<?php
namespace EkAndreas\Listig\Model;

/**
 * Handles user settings
 *
 * Class UserSettingModel
 * @package EkAndreas\Listig\Model
 */
class UserSettingModel
{
    public $optionKey = 'listig-';
    public $fields = [];

    /**
     * UserSettingModel constructor.
     */
    public function __construct()
    {
        $userId = wp_get_current_user()->ID;
        $userId = $userId ? $userId : 1; // admin hack for development
        $this->optionKey = 'listig-' . $userId;
        $this->fields = get_option($this->optionKey, []);
    }

    /**
     * Magic getting value from object
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->fields[ $key ];
    }

    /**
     * Magic setting field for user
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->fields[ $key ] = $value;
    }

    /**
     * @return \stdClass
     */
    public static function all()
    {
        $setting = new static();
        return $setting->fields;
    }

    /**
     * Saving fields to personalized WordPress option
     */
    public function save()
    {
        update_option($this->optionKey, $this->fields);
    }
}
