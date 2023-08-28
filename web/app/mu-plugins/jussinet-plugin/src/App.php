<?php 
namespace JussiNet;

class App
{
    public function init()
    {
        $this->registerPostTypes();
    }

    public function registerPostTypes()
    {
        (new Cpt\Project)->init();
        (new Service\ApiService)->init();
    }
}