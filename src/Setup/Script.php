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

        $manifest = json_decode(file_get_contents(__DIR__.'/../../mix-manifest.json'), true);

        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('listig_css', plugins_url('listig/'.$manifest['assets/css/app.css']));

        $data = [
            'lang' => \EkAndreas\Listig\Language\Script::translations(),
            'nonce' => wp_create_nonce('wp_rest'),
            'restUrl' => Base::url,
            'userSettings' => UserSettingModel::all(),
        ];

        wp_register_script('listig_js', plugins_url('listig/'.$manifest['assets/js/app.js']), [], null, true);
        wp_localize_script('listig_js', 'listig', $data);
        wp_enqueue_script('listig_js');

        if ($hook == 'toplevel_page_listig/main') {
            wp_register_script('listig_main_page_js', plugins_url('listig/assets/js/main-page.js'), [], null, true);
            wp_localize_script('listig_main_page_js', 'listig', $data);
            wp_enqueue_script('listig_main_page_js');
        }
    }
}
