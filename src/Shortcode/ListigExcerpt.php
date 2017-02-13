<?php
namespace EkAndreas\Listig\Shortcode;

class ListigExcerpt implements ShortcodeInterface
{
    public static function tag()
    {
        return 'listig-excerpt';
    }

    public static function handle($atts = [], $content = null)
    {
        $currentItem = apply_filters('listig/currentItem', new \stdClass());
        return $currentItem->excerpt;
    }
}
