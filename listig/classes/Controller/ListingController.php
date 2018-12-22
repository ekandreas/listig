<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class ListingController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/listing/(?P<id>\d+)', __CLASS__ . '@get');
        Base::get('/listing', __CLASS__ . '@all');
        Base::post('/listing/(?P<id>\d+)/posts', __CLASS__ . '@savePosts');
        Base::post('/listing/(?P<id>\d+)', __CLASS__ . '@save');
        Base::delete('/listing/(?P<id>\d+)', __CLASS__ . '@delete');
    }

    public function all(\WP_REST_Request $request)
    {
        $result = ListingModel::all();
        return $result;
    }

    public function get(\WP_REST_Request $request)
    {
        $id = (int)$request->get_param('id');
        return ListingModel::get($id);
    }

    public function save(\WP_REST_Request $request)
    {
        $listing = new ListingModel($request->get_json_params());
        return $listing->save();
    }

    public function delete(\WP_REST_Request $request)
    {
        $id = (int)$request->get_param('id');
        ListingModel::delete($id);
        return $id;
    }

    public function savePosts(\WP_REST_Request $request)
    {
        $id = (int)$request->get_param('id');
        $params = $request->get_json_params();

        $listing = new ListingModel($id);
        $listing->posts = isset($params) ? $params : [];
        $listing->save();

        return $listing;
    }
}
