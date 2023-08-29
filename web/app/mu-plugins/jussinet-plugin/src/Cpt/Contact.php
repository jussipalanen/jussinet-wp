<?php

namespace JussiNet\Cpt;

use JussiNet\Codes;

class Contact
{
    public function init()
    {
        # Our custom post type function
        register_post_type(
            Codes::CONTACT_POST_TYPE,
            # CPT Options
            array(
                'labels' => array(
                    'name' => __('Contacts'),
                    'singular_name' => __('Contact')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => 'contacts'],
                'show_in_rest' => true,
                'supports' => array('title'),
            )
        );
    }
}
