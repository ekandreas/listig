<?php
namespace EkAndreas\Listig\Setup;

class PostType
{
    public static function register()
    {
        $labels = [
            'name'               => 'Listig',
            'singular_name'      => 'Listig',
        ];
        \register_post_type('listig', [
            'labels' => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
        ]);
    }
}
