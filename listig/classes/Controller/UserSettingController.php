<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\UserSettingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class UserSettingController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/user-setting', __CLASS__ . '@all');
        Base::post('/user-setting', __CLASS__ . '@save');
    }

    public function all(\WP_REST_Request $request)
    {
        $setting = UserSettingModel::all();
        return $setting;
    }

    public function save(\WP_REST_Request $request)
    {
        $setting = UserSettingModel::all();

        foreach ($request->get_json_params() as $key => $value) {
            $setting->{$key} = $value;
        }

        $setting->save();
        return ['result' => 'success'];
    }
}
