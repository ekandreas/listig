<?php
/*
Plugin Name: Listig
Plugin URI:  https://github.com/ekandreas/listig/
Description: List Manager
Version:     0.2.6
Author:      Andreas Ek
Author URI:  https://www.elseif.se/
License:     MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: listig
Domain Path: /languages
*/


/**
 * Check for PHP >= 7 and nag an error if not true!
 */
if (PHP_VERSION<7) {
    add_action('admin_notices', 'listig_requires_php_version_7');
    function listig_requires_php_version_7()
    {
        $class = 'notice notice-error';
        $message = __('Plugin "listig" requires at least PHP7. Please upgrade PHP or inactivate the plugin!', 'listig');
        printf('<div class="%1$s"><p>%2$s</p></div>', $class, $message);
    }
    return;
}

/**
 * Namespace autoload outside of Composer to reach WordPress plugin compability without Composer
 */
require_once 'autoload.php';

/**
 * Global registrations, functions and filters
 */
require_once 'globals/required.php';
