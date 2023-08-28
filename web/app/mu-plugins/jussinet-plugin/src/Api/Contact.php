<?php 
namespace JussiNet\Api;

use WP_REST_Request;

class Contact
{
    public $apiUrl = '/contact';

    /**
     * /api/contact/send
     *
     * @return void
     */
    public function send( WP_REST_Request $request )
    {
        $data = $request->get_params();
        $post_ID = wp_insert_post([
            'post_title' =>  (($data['firstname'] ?: null) && ($data['lastname'] ?: null)) ? trim($data['firstname'] . ' ' . $data['lastname'])  : 'Contact message',
            'post_type' => 'contacts',
        ]);

        $post = get_post( $post_ID );
        if( is_wp_error($post) )
        {
            wp_send_json_error('An error happened to insert a new contact. Please try again.');
        }

        $fields = [
            'firstname' => $data['firstname'] ?: null,
            'lastname' => $data['lastname'] ?: null,
            'email' => $data['email'] ?: null,
            'phone' => $data['phone'] ?: null,
            'message' => $data['message'] ?: null,
        ];
        foreach ($fields as $key => $value) {
            update_field($key, $value, $post_ID );
        }
        wp_send_json_success('The contact was sent successfully.');
    }
}