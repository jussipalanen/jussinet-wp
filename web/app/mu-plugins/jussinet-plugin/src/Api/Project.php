<?php 
namespace JussiNet\Api;

use JussiNet\Codes;
use WP_REST_Request;

class Project
{
    public $apiUrl = '/project';

    /**
     * /api/project/all
     *
     * @return void
     */
    public function all()
    {
        $posts = get_posts([
            'posts_per_page' => -1,
            'post_type' => Codes::PROJECT_POST_TYPE,
            'post_status' => 'publish',
        ]);

        $posts = array_map( function($item)
        {
            $item->featured_image = get_the_post_thumbnail_url( $item, 'default' ) ?: null;
            $item->tags = get_the_terms( $item->ID, 'tag' ) ?: [];
            return $item;
        }, $posts);
        return $posts;
    }
    
    /**
     * /api/project/get
     *
     * @return void
     */
    public function get(WP_REST_Request $request)
    {
        $post = get_posts([
            'name' => $request->get_param('slug'),
            'post_type' => Codes::PROJECT_POST_TYPE,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ]);
        return !empty($post) ? reset($post) : wp_send_json_error('The project not found');
    }


}