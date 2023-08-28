<?php
namespace JussiNet\Service;


/**
 * App Service
 */
class AppService
{
    private $parent = 'jussinet-app';

    /**
     * Init the subclasses, hooks etc.
     *
     * @return void
     */
    public function init()
    {
        $this->filters();
        $this->actions();
        $this->pages();
    }

    /**
     * Registering the pages, option pages, etc.
     *
     * @return void
     */
    public function pages()
    {
        if (function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page')) 
        {
            acf_add_options_page([
                'page_title'    => 'App',
                'menu_title'    => 'App',
                'menu_slug'     => $this->parent,
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]);

            acf_add_options_sub_page([
                'page_title'    => 'About',
                'menu_title'    => 'About',
                'menu_slug'     => $this->parent . '-about',
                'parent_slug'   => $this->parent,
            ]);
        }
    }

    /**
     * Add the actions hooks for site and plugins
     *
     * @return void
     */
    public function actions()
    {
    }

    /**
     * Add the filters for the site and plugins
     *
     * @return void
     */
    public function filters()
    {

        /**
         * Disable the gutenberg editor from the specific post types
         */
        add_filter( 'use_block_editor_for_post_type', function($current_status, $post_type)
        {
            // Disabled post types
            $disabled_post_types = ['contacts'];
        
            // Change $can_edit to false for any post types in the disabled post types array
            if ( in_array( $post_type, $disabled_post_types, true ) ) {
                $current_status = false;
            }
        
            return $current_status;
        }, 10, 2 );
    }

}
