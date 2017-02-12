<?php
namespace EkAndreas\Listig\Menu;

use EkAndreas\Listig\Page\HelpPage;
use EkAndreas\Listig\Page\MainPage;
use EkAndreas\Listig\Page\SettingsPage;

class AdminMenu
{
    public static function pages()
    {
        return [
            'toplevel_page_listig/main',
            'listig_page_listig/settings',
            'listig_page_listig/help'
        ];
    }

    public static function register()
    {
        add_menu_page(
            'Listig',
            'Listig',
            'manage_options',
            'listig/main',
            'EkAndreas\Listig\Menu\AdminMenu::main',
            'dashicons-editor-ul', 33
        );

        /*
        add_submenu_page(
            'listig/main',
            __('Help'),
            __('Help'),
            'manage_options',
            'listig/help',
            'EkAndreas\Listig\Menu\AdminMenu::help'
        );

        add_submenu_page(
            'listig/main',
            __('Settings'),
            __('Settings'),
            'manage_options',
            'listig/settings',
            'EkAndreas\Listig\Menu\AdminMenu::settings'
        );
        */
    }

    public static function main()
    {
        $mainPage = new MainPage();
        echo $mainPage->view();
    }

    public static function help()
    {
        $helpPage = new HelpPage();
        echo $helpPage->view();
    }

    public static function settings()
    {
        $settingsPage = new SettingsPage();
        echo $settingsPage->view();
    }
}
