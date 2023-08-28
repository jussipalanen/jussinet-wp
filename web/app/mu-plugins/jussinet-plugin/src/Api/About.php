<?php 
namespace JussiNet\Api;

class About
{
    public $apiUrl = '/about';

    /**
     * /api/about/get
     *
     * @return void
     */
    public function get()
    {
        return [
            'name' => get_field('person_name', 'option'),
            'job_title' => get_field('job_title', 'option'),
            'image' => get_field('person_image', 'option'),
            'introduction' => get_field('introduction', 'option'),
            'skill_groups' => get_field('skill_groups', 'option'),
        ];
    }

}