<?php

namespace EkAndreas\Listig\Setup;

class PostType implements SetupInterface
{
    public function __construct()
    {
        add_action('init', function () {
            $labels = [
                'name' => 'Listig',
                'singular_name' => 'Listig',
            ];
            \register_post_type('listig', [
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => LISTIG_POSTTYPE_VISIBLE,
                'show_in_menu' => LISTIG_POSTTYPE_VISIBLE,
                'supports' => [
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'excerpt',
                    'revisions'
                ],
            ]);
        });
    }
}
