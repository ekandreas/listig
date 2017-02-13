<?php
namespace EkAndreas\Listig\Shortcode;

interface ShortcodeInterface
{
    public static function tag();

    public static function handle($atts = [], $content = null);
}
