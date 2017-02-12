<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class PostSearchController implements RouteInterface
{
    public static function routes()
    {
        Base::post('/post-search', __CLASS__ . '@search');
    }

    public function search(\WP_REST_Request $request)
    {
        $params = $request->get_json_params();

        $args = [
            'posts_per_page' => $params['postsPerPage'],
            'paged' => $params['page'],
            'orderby' => 'date',
            'order' => 'ASC',
        ];

        if ($params['posttype']) {
            $args['post_type'] = $params['posttype'];
        }
        if ($params['author']) {
            $args['author'] = $params['author'];
        }
        if ($params['search']) {
            $args['s'] = $params['search'];
        }

        $query = new \WP_Query($args);

        $result = [
            'posts' => [],
        ];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $imageId = (int)get_post_thumbnail_id();
                $imageUrl = $imageId ? wp_get_attachment_image_url($imageId): '';

                $row = apply_filters('listig/post', [

                    'id' => get_the_ID(),

                    'headline' => get_the_title(),

                    'excerpt' => apply_filters('listig/strip_tags', true) ?
                        strip_tags(get_the_excerpt()) :
                        get_the_excerpt(),

                    'url' => get_the_permalink(),

                    'imageId' => $imageId,
                    'imageUrl' => $imageUrl,

                ]);

                $result['posts'][] = $row;
            }
        }

        $result['query'] = $query;

        wp_reset_postdata();

        return $result;
    }
}
