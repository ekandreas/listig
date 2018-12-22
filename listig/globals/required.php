<?php
/**
 * This file is just an autoload index to glabally load other requirements
 */

require_once 'definitions.php';
require_once 'language.php';
require_once 'custom-filters.php';
require_once 'registers.php';
require_once 'functions.php';

$base = "EkAndreas\\Listig\\Setup\\";
foreach (glob(__DIR__ . "/../classes/Setup/*.php") as $file) {
    $className = pathinfo($file)['filename'];
    if(in_array("{$base}SetupInterface", class_implements("{$base}{$className}"))) {
        $fullClassName = "{$base}{$className}";
        new $fullClassName();
    }
}
