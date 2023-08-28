<?php
namespace JussiNet\Service;

use JussiNet\Api;


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
        $this->about    = (new Api\About);

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
            'methods' => 'GET',
            'callback' => [$this->project, 'all'],
        ));

        register_rest_route('api', $this->project->apiUrl . '/get/(?P<slug>[a-z0-9]+(?:-[a-z0-9]+)*)', array(
            'methods' => 'GET',
            'callback' => [$this->project, 'get'],
        ));


        /**
         * News
         */
        register_rest_route('api', $this->news->apiUrl . '/all', array(
            'methods' => 'GET',
            'callback' => [$this->news, 'all'],
        ));

        register_rest_route('api', $this->news->apiUrl . '/get/(?P<slug>[a-z0-9]+(?:-[a-z0-9]+)*)', array(
            'methods' => 'GET',
            'callback' => [$this->news, 'get'],
        ));



        /**
         * About
         */
        register_rest_route('api', $this->about->apiUrl . '/get', array(
            'methods' => 'GET',
            'callback' => [$this->about, 'get'],
        ));



    }
}
