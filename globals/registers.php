<?php
/**
 * Different register services made globally for the plugin application
 */

new \EkAndreas\Listig\Route\RouteService([
    EkAndreas\Listig\Controller\ListingController::class,
    EkAndreas\Listig\Controller\AuthorController::class,
    EkAndreas\Listig\Controller\PostTypeController::class,
    EkAndreas\Listig\Controller\PostSearchController::class,
    EkAndreas\Listig\Controller\UserSettingController::class,
]);