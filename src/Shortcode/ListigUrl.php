<?php
namespace EkAndreas\Listig\Shortcode;

class ListigUrl implements ShortcodeInterface
{
    public static function tag()
    {
        return 'listig-url';
    }

    public static function handle($atts = [], $content = null)
    {
        $result = "";

        $params = shortcode_atts(array(
            'target' => null,
        ), $atts);

        $currentItem = apply_filters('listig/currentItem', new \stdClass());

        if ($currentItem) {
            $result = "<a href=\"{$currentItem->url}\"";
            if ($params['target']) {
                $result .= " target=\"{$params['target']}\"";
            }
            $result .= ">{$content}</a>";
        }

        return $result;
    }
}
