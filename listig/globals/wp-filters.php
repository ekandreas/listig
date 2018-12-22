<?php

add_action('admin_init', function () {
    load_plugin_textdomain('listig', false, dirname(LISTING_PLUGIN_FILE) . '/listig/languages');
});

add_action('init', function () {
    EkAndreas\Listig\Setup\PostType::register();
});

add_action('admin_menu', 'EkAndreas\Listig\Menu\AdminMenu::register');
add_action('admin_enqueue_scripts', 'EkAndreas\Listig\Setup\Script::register');
