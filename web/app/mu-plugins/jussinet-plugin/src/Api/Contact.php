<?php

namespace JussiNet\Api;

use JussiNet\Codes;
use WP_REST_Request;

use function Env\env;

class Contact
{
    public $apiUrl = '/contact';

    /**
     * /api/contact/send
     *
     * @return void
     */
    public function send(WP_REST_Request $request)
    {
        # Get the data
        $data = $request->get_params();

        # validate the data
        $this->validation($data);

        $post_ID = wp_insert_post([
            'post_title' => (($data['firstname'] ?: null) && ($data['lastname'] ?: null)) ? trim($data['firstname'] . ' ' . $data['lastname'])  : 'Contact message',
            'post_type' => Codes::CONTACT_POST_TYPE,
            'post_status' => 'publish',
        ]);

        $post = get_post($post_ID);
        if (is_wp_error($post)) {
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
            update_field($key, $value, $post_ID);
        }
        wp_send_json_success('The contact was sent successfully.');
    }


    /**
     * Basic validation and re-captcha check
     *
     * @return void
     */
    private function validation()
    {
        # Validation 
        $fields = [
            'firstname',
            'lastname',
            'email',
            'message',
            'robot'
        ];

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (isset($fields[$key]) && $value == null || empty($value)) {
                    $errors[$key] = sprintf("The %s is required field.", $value);
                }
            }

            if (isset($data['robot'])) {
                $gresponse = $data['robot'];
                $isVerify = $this->verifyGoogleReCaptcha($gresponse);
                if (!$isVerify) {
                    $errors['robot'] = sprintf("The re-catpcha is not valid.", $value);
                }
            }
        }

        # Show the errors, if exists
        if (!empty($errors)) {
            wp_send_json_error([
                'errors' => $errors,
            ]);
        }
    }

    /**
     * Validate the Google re-captcha code
     *
     * @param [type] $response
     * @return void
     */
    private function verifyGoogleReCaptcha($gresponse)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $response = wp_remote_post($url, [
            'body' => [
                'secret'   => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $gresponse,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ]
        ]);

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['success']) && $body['success']) {
            return true;
        }
        return false;
    }
}
