<?php
namespace EkAndreas\Listig\Model;

class ListingModel
{
    const postType = "listig";

    public $id = 0;
    public $name = '';
    public $private = false;
    public $description = '';
    public $posts = [];

    /**
     * ListingModel constructor.
     * @param stdClass | int $args
     */
    public function __construct($args)
    {
        if (is_array($args)) {
            $this->id = (int)$args['id'];
            $this->name = $args['name'];
            $this->description = $args['description'];
            $this->private = $args['private'];
            $this->posts = isset($args['posts']) && is_array($args['posts']) ? $args['posts'] : [];
        }

        if (is_integer($args)) {
            $post = get_post($args);
            $object = json_decode($post->post_content, false, 512, JSON_UNESCAPED_UNICODE);
            $this->id = $post->ID;
            $this->name = isset($object->name) ? $object->name : '';
            $this->description = isset($object->description) ? $object->description : '';
            $this->private = isset($object->private) ? $object->private : false;
            $this->posts = isset($object->posts) && is_array($object->posts) ? $object->posts : [];
        }
    }

    public static function all()
    {
        $result = [];
        $args = [
            'post_type' => 'listig',
            'posts_per_page' => -1,
        ];
        $posts = get_posts($args);
        foreach ($posts as $post) {
            $listing = new ListingModel($post->ID);
            $result[] = $listing;
        }
        return $result;
    }

    public function save()
    {
        global $wpdb;

        if ($this->id == 0) {
            $this->id = wp_insert_post([
                'post_title' => $this->name,
                'post_type' => $this::postType,
                'post_status' => 'publish',
            ]);
        }

        $wpdb->update(
            "{$wpdb->prefix}posts",
            [
                'post_title' => $this->name,
                'post_content' => json_encode($this, JSON_UNESCAPED_UNICODE),
            ],
            ['ID' => $this->id]
        );

        // WP manipulates data, we want to store unformatted data inside post_content to get version handling.
        //wp_update_post([
        //    'ID' => $this->id,
        //    'post_title' => $this->name,
        //    'post_content' => serialize($this), // ,
        //]);

        return ListingModel::get($this->id);
    }

    /**
     * @param $id
     */
    public static function delete($id)
    {
        wp_delete_post($id);
    }

    /**
     * @param $id
     * @return null|static
     */
    public static function get($id)
    {
        // easy check if post exists
        $status = get_post_status($id);

        if ($status) {
            return new ListingModel($id);
        }
        return null;
    }
}
