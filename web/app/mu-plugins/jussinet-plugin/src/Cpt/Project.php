<?php

namespace JussiNet\Cpt;

class Project
{
    public function init()
    {
        # Our custom post type function
        register_post_type(
            'projects',
            # CPT Options
            array(
                'labels' => array(
                    'name' => __('Projects'),
                    'singular_name' => __('Project')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => 'projects'],
                'show_in_rest' => true,
                'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            )
        );
    }
}
