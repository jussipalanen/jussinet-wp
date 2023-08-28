<?php
namespace JussiNet\Service;


/**
 * App Service
 */
class AppService
{
    private $parent = 'jussinet-app';

    /**
     * Init the pages e.g option pages and other stuff...
     *
     * @return void
     */
    public function init()
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

}
