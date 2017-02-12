<?php
/*
Plugin Name: Listig
Plugin URI:  https://github.com/ekandreas/listig/
Description: List Manager
Version:     0.1
Author:      Andreas Ek
Author URI:  https://www.elseif.se/
License:     MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: listig
Domain Path: /languages
*/

/**
 * Namespace autoload outside of Composer to reach WordPress plugin compability without Composer
 */
require_once 'autoload.php';

/**
 * Global registrations, functions and filters
 */
require_once 'globals/required.php';
