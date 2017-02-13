<?php
namespace EkAndreas\Listig\Shortcode;

class ListigHeadline implements ShortcodeInterface
{
    public static function tag()
    {
        return 'listig-headline';
    }

    public static function handle($atts = [], $content = null)
    {
        $currentItem = apply_filters('listig/currentItem', new \stdClass());
        return $currentItem->headline;
    }
}
