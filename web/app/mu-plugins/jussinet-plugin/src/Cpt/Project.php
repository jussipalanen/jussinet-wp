<?php

namespace JussiNet\Cpt;

use JussiNet\Codes;

class Project
{
    public function init()
    {
        # Our custom post type function
        register_post_type(
            Codes::PROJECT_POST_TYPE,
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
                'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            )
        );

        register_taxonomy('tag', Codes::PROJECT_POST_TYPE, array(
            'labels' => array(
                'name' => _x('Tags', 'taxonomy general name'),
                'singular_name' => _x('Tag', 'taxonomy singular name'),
                'search_items' =>  __('Search Tags'),
                'popular_items' => __('Popular Tags'),
                'all_items' => __('All Tags'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Tag'),
                'update_item' => __('Update Tag'),
                'add_new_item' => __('Add New Tag'),
                'new_item_name' => __('New Tag Name'),
                'separate_items_with_commas' => __('Separate tags with commas'),
                'add_or_remove_items' => __('Add or remove tags'),
                'choose_from_most_used' => __('Choose from the most used tags'),
                'menu_name' => __('Tags'),
            ),
            'hierarchical' => false,
            'show_in_rest' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'tag'),
        ));
        
    }
}
