<?php
namespace EkAndreas\Listig\Menu;

use EkAndreas\Listig\Page\MainPage;

class AdminMenu
{
    public static function pages()
    {
        return [
            'toplevel_page_listig/main',
            'listig_page_listig/settings'
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

        add_submenu_page(
            'listig/main',
            __('Settings'),
            __('Settings'),
            'manage_options',
            'listig/settings',
            'EkAndreas\Listig\Menu\AdminMenu::settings'
        );
    }

    public static function main()
    {
        $mainPage = new MainPage();
        echo $mainPage->view();
    }

    public static function settings()
    {
        $settingsPage = new MainPage();
        echo $settingsPage->view();
    }
}
