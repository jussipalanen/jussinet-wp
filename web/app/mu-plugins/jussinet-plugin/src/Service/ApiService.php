<?php
namespace JussiNet\Service;

use JussiNet\Api;

class ApiService
{

    private $project;
    private $contact;
    private $news;

    public function init()
    {
        $this->project = (new Api\Project);
        $this->contact = (new Api\Contact);
        $this->news = (new Api\News);

        add_action('rest_api_init', [$this, 'routes'] );
    }

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

    }
}
