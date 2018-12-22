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
                'show_in_rest' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'supports' => [
                    'title',
                    'editor',
                    'author',
                    'revisions'
                ],
            ]);
        });
    }
}
