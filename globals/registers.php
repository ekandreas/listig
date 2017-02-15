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
    \EkAndreas\Listig\Controller\HelperController::class,
]);

new \EkAndreas\Listig\Shortcode\ShortcodeService([
    \EkAndreas\Listig\Shortcode\Listig::class,
    \EkAndreas\Listig\Shortcode\ListigHeadline::class,
    \EkAndreas\Listig\Shortcode\ListigExcerpt::class,
    \EkAndreas\Listig\Shortcode\ListigUrl::class,
    \EkAndreas\Listig\Shortcode\ListigImage::class,
]);
