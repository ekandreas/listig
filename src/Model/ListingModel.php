<?php
namespace EkAndreas\Listig\Model;

class ListingModel
{
    const postType = "listig";

    public $id = 0;
    public $name = '';
    public $private = false;
    public $description = '';

    /**
     * ListingModel constructor.
     * @param stdClass | int $args
     */
    public function __construct($args)
    {
        if(is_array($args)) {
            $this->id = (int)$args['id'];
            $this->name = $args['name'];
            $this->description = $args['description'];
            $this->private = $args['private'];
        }

        if (is_integer($args)) {
            $post = get_post($args);
            $object = json_decode($post->post_content);
            $this->id = $post->ID;
            $this->name = $object->name;
            $this->description = $object->description;
            $this->private = $object->private;
        }
    }

    public static function all() {
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
        if ($this->id == 0) {
            $this->id = wp_insert_post([
                'post_title' => $this->name,
                'post_type' => $this::postType,
                'post_status' => 'publish',
            ]);
        }

        wp_update_post([
            'ID' => $this->id,
            'post_title' => $this->name,
            'post_content' => json_encode($this, JSON_UNESCAPED_UNICODE),
        ]);

        return $this;
    }

    public function delete($id) {
        wp_delete_post($id);
    }
}
