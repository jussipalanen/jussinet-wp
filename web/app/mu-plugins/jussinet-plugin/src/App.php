<?php 
namespace JussiNet;
/**
 * The main class of the plugin
 */
class App
{

    /**
     * Init the classes
     *
     * @return void
     */
    public function init()
    {
        $this->postTypes();
        $this->services();
    }

    /**
     * Registering the post types
     *
     * @return void
     */
    public function postTypes()
    {
        (new Cpt\Project)->init();
        (new Cpt\Contact)->init();
    }


    /**
     * Registering the services
     *
     * @return void
     */
    public function services()
    {
        (new Service\AppService)->init();
        (new Service\ApiService)->init();
        
    }
}