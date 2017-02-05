<?php
/*
Plugin Name: Listig
Plugin URI:  https://github.com/ekandreas/listig/
Description: List Manager
Version:     0.0.1
Author:      Andreas Ek
Author URI:  https://www.elseif.se/
License:     MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: listig
Domain Path: /languages
*/

require_once 'autoload.php';

add_action( 'admin_init', function(){
    load_plugin_textdomain( 'listig', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});

add_action('init', function() {
   EkAndreas\Listig\Setup\PostType::register();
});

add_action( 'admin_menu', 'EkAndreas\Listig\Menu\AdminMenu::register' );
add_action( 'admin_enqueue_scripts', 'EkAndreas\Listig\Setup\Script::register' );

new \EkAndreas\Listig\Route\RouteService([
    EkAndreas\Listig\Controller\ListingController::class,
    EkAndreas\Listig\Controller\AuthorController::class,
    EkAndreas\Listig\Controller\PostTypeController::class,
    EkAndreas\Listig\Controller\PostSearchController::class,
]);
