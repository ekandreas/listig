<?php
namespace EkAndreas\Listig\Route;

class Base
{
    const uri = "listig";
    const url = "/wp-json/" . Base::uri;

    public static function get($path, $classFunction, $auth = true)
    {
        self::register($path, [
            'methods' => 'GET',
            'callback' => Base::resolved($classFunction),
            'permission_callback' => $auth ? __CLASS__.'::permission' : null,
        ]);
    }

    public static function post($path, $classFunction)
    {
        self::register($path, [
            'methods' => 'POST',
            'callback' => Base::resolved($classFunction),
            'permission_callback' => __CLASS__.'::permission',
        ]);
    }

    public static function put($path, $classFunction)
    {
        self::register($path, [
            'methods' => 'PUT',
            'callback' => Base::resolved($classFunction),
            'permission_callback' => __CLASS__.'::permission',
        ]);
    }

    public static function delete($path, $classFunction)
    {
        self::register($path, [
            'methods' => 'DELETE',
            'callback' => Base::resolved($classFunction),
            'permission_callback' => __CLASS__.'::permission',
        ]);
    }

    public static function register($path, $args)
    {
        \register_rest_route(self::uri, $path, [
            'methods' => $args['methods'],
            'callback' => $args['callback'],
            'permission_callback' => $args['permission_callback'],
        ]);
    }

    public static function resolved($classOrFunction)
    {
        if (preg_match('/@/', $classOrFunction)) {
            $splitted = explode('@', $classOrFunction);
            $class = $splitted[0];
            $function = $splitted[1];
            $objectInstance = new $class;

            return [$objectInstance, $function];
        }

        return $classOrFunction;
    }

    public static function permission()
    {
        return ((bool)defined('WP_DEBUG') && true === WP_DEBUG) || is_user_logged_in();
    }
}
