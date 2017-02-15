<?php
namespace EkAndreas\Listig\Setup;

use EkAndreas\Listig\Menu\AdminMenu;
use EkAndreas\Listig\Model\UserSettingModel;
use EkAndreas\Listig\Route\Base;

class Script
{
    public static function register($hook)
    {
        if (!in_array($hook, AdminMenu::pages())) {
            return;
        }

        wp_enqueue_media();

        $manifest = json_decode(file_get_contents(__DIR__.'/../../mix-manifest.json'), true);

        $pluginData = apply_filters('listig/pluginData', []);
        $version = isset($pluginData['Version']) ? $pluginData['Version'] : uniqid();

        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('listig_css', plugins_url('listig/'.$manifest['/dist/app.css']), [], $version);

        $data = [
            'lang' => \EkAndreas\Listig\Language\Script::translations(),
            'nonce' => wp_create_nonce('wp_rest'),
            'restUrl' => Base::url,
            'userSettings' => UserSettingModel::all(),
        ];

        wp_register_script('listig_js', plugins_url('listig/'.$manifest['/dist/app.js']), [], $version, true);
        wp_localize_script('listig_js', 'listig', $data);
        wp_enqueue_script('listig_js');
    }
}
