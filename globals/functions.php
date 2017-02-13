<?php
/**
 * Global functions to create a WordPress developer API
 */

// TODO: Always check for function_exists!

if (!function_exists('listig')) {

    /**
     * Returns a list of posts (id, headline, excerpt, image) from a list id
     *
     * @param $id
     * @return array
     */
    function listig($id)
    {
        $id = (int)$id;
        $listig = \EkAndreas\Listig\Model\ListingModel::get($id);
        if ($listig && $listig->posts) {
            return $listig->posts;
        }
        return [];
    }
}
