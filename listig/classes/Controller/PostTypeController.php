<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class PostTypeController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/posttype', __CLASS__ . '@all');
    }

    public function all(\WP_REST_Request $request)
    {
        $args = [
            'public' => true,

        ];
        $posttypes = get_post_types($args, 'objects');

        return $posttypes;
    }
}
