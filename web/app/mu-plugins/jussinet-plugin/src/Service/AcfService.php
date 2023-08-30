<?php

namespace JussiNet\Service;


/**
 * Advanced Custom Fields service
 */
class AcfService
{
    private $path;
    public function init()
    {
        $this->path = untrailingslashit(plugin_dir_path(__DIR__) . '/../acf-json');
        if( !is_dir( $this->path ) )
        {
            mkdir( $this->path, 0777, true );
        }
        add_filter('acf/settings/save_json', [$this, 'saveJson'], 10);
        add_filter('acf/settings/load_json', [$this, 'loadJson'], 10);
    }

    /**
     * Save the json file
     *
     * @param [type] $path
     * @return void
     */
    public function saveJson($path)
    {
        # Return path
        return $this->path;
    }


    /**
     * Load the json file
     *
     * @param [type] $paths
     * @return void
     */
    public function loadJson($paths)
    {
        # Remove original path
        unset($paths[0]);
        # Append our new path
        $paths[] = $this->path;
        return $paths;
    }
}
