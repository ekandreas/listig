<?php
namespace EkAndreas\Listig\Controller;

use EkAndreas\Listig\Model\ListingModel;
use EkAndreas\Listig\Route\Base;
use EkAndreas\Listig\Route\RouteInterface;

class HelperController implements RouteInterface
{
    public static function routes()
    {
        Base::get('/helper/attachment/url/(?P<id>\d+)', __CLASS__ . '@attachmentUrl');
    }

    public function attachmentUrl(\WP_REST_Request $request)
    {
        $url = wp_get_attachment_url((int)$request->get_param('id'));

        return str_replace(get_bloginfo('url'), '', $url);
    }
}
