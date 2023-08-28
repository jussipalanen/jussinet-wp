<?php

use JussiNet\App;

require_once('vendor/autoload.php');
/**
 * Plugin Name:  JussiNet 
 * Plugin URI:   https://www.jussialanen.com
 * Description:  The main plugin for the Jussinet site. This disable frontend, and allows the backend and API usage.
 * Version:      1.0.0
 * Author:       Jussi Alanen
 * Author URI:   https://www.jussialanen.com
 * License:      MIT License
 */


add_action('init', [new App, 'init']);