<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class ListingController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/listing', __CLASS__ . '@all');
        Base::post('/listing/(?P<id>\d+)', __CLASS__ . '@save');
        Base::delete('/listing/(?P<id>\d+)', __CLASS__ . '@delete');
    }

    public function all(\WP_REST_Request $request)
    {
        $result = ListingModel::all();
        return $result;
    }

    public function save(\WP_REST_Request $request)
    {
        $listing = new ListingModel($request->get_json_params());
        $listing->save();
        return $listing;
    }

    public function delete(\WP_REST_Request $request)
    {
        $id = (int)$request->get_param('id');
        ListingModel::delete($id);
        return $id;
    }

}
