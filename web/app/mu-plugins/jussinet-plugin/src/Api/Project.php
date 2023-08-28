<?php 
namespace JussiNet\Api;

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
            'post_type' => 'projects',
        ]);

        $posts = array_map( function($item)
        {
            $item->featured_image = get_the_post_thumbnail_url( $item, 'default' ) ?: null;
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
            'post_type' => 'projects',
            'posts_per_page' => -1,
        ]);
        return !empty($post) ? reset($post) : wp_send_json_error('The project not found');
    }


}