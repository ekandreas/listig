<?php
namespace EkAndreas\Listig\Shortcode;

class ListigImage implements ShortcodeInterface
{
    public static function tag()
    {
        return 'listig-image';
    }

    public static function handle($atts = [], $content = null)
    {
        $params = shortcode_atts([
            'size' => 'full',
            'icon' => false,
            'attr' => '',
        ], $atts);

        $currentItem = apply_filters('listig/currentItem', new \stdClass());

        $image = wp_get_attachment_image(
            $currentItem->imageId,
            $params['size'],
            $params['icon'],
            $params['attr']);

        return $image;
    }
}
