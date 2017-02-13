<?php
namespace EkAndreas\Listig\Shortcode;

class Listig implements ShortcodeInterface
{
    public static function tag()
    {
        return 'listig';
    }

    public static function handle($atts = [], $content = null)
    {
        $result = "";

        $params = shortcode_atts(array(
            'id' => 0,
        ), $atts);

        $items = listig($params['id']);

        if ($items) {
            foreach ($items as $key => $item) {
                add_filter("listig/currentItem", function () use ($item) {
                    return $item;
                });

                $result .= do_shortcode($content);
            }
        }

        return $result;
    }
}
