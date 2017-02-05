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
            'posts_per_page' => 20,
            'page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
        ];

        if ($params['posttype']) $args['post_type'] = $params['posttype'];
        if ($params['author']) $args['author'] = $params['author'];
        if ($params['search']) $args['s'] = '%' . $params['search'] . '%';

        $query = new \WP_Query($args);

        //while ( $query->have_posts() ) {
        //    $query->the_post();
        //}

        wp_reset_postdata();

        return $query;
    }

}
