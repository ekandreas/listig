<?php

namespace EkAndreas\Listig\Setup;

class AdminMenu implements SetupInterface
{
    public function __construct()
    {
        add_action('admin_menu', 'EkAndreas\Listig\Menu\AdminMenu::register');
    }
}
