<?php
namespace JussiNet\Service;

use JussiNet\Api;
use WP_REST_Server;

/**
 * API service
 */
class ApiService
{

    private $project;
    private $contact;
    private $news;
    private $about;


    /**
     * Init the variables
     *
     * @return void
     */
    public function init()
    {
        $this->project = (new Api\Project);
        $this->contact = (new Api\Contact);
        $this->news    = (new Api\News);
        $this->about   = (new Api\About);

        add_action('rest_api_init', [$this, 'routes'] );
    }


    /**
     * Registering the API rest routes
     *
     * @return void
     */
    public function routes()
    {
        /**
         * Projects
         */
        register_rest_route('api', $this->project->apiUrl . '/all', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this->project, 'all'],
            'permission_callback' => '__return_true',
        ));

        register_rest_route('api', $this->project->apiUrl . '/get/(?P<slug>[a-z0-9]+(?:-[a-z0-9]+)*)', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this->project, 'get'],
            'permission_callback' => '__return_true',
        ));


        /**
         * News
         */
        register_rest_route('api', $this->news->apiUrl . '/all', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this->news, 'all'],
            'permission_callback' => '__return_true',
        ));

        register_rest_route('api', $this->news->apiUrl . '/get/(?P<slug>[a-z0-9]+(?:-[a-z0-9]+)*)', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this->news, 'get'],
            'permission_callback' => '__return_true',
        ));

        /**
         * About
         */
        register_rest_route('api', $this->about->apiUrl . '/get', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this->about, 'get'],
            'permission_callback' => '__return_true',
        ));

         /**
         * Contact
         */
        register_rest_route('api', $this->contact->apiUrl . '/send', array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => [$this->contact, 'send'],
            'permission_callback' => '__return_true',
        ));
    }
}
