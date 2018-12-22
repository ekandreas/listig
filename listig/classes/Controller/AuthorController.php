<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class AuthorController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/author', __CLASS__ . '@all');
    }

    public function all(\WP_REST_Request $request)
    {
        $args = array(
            'orderby'      => 'display_name',
            'order'        => 'ASC',
            'fields'       => 'all',
            'who'          => 'authors'
        );
        $users = get_users($args);

        return $users;
    }
}
