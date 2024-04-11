<?php
/**
 * Plugin Name: Line Art Content Iframe.
 * Plugin URI: http://www.linhaartistica.com.br
 * Description: Content Iframe to use im block
 * Version: 1.0
 * Author: Kleber Santos
 */


define('LA_C_IFRAME_PATH', plugin_dir_path(__DIR__) . 'linha-content-iframe/');
define('LA_C_IFRAME_URL', plugin_dir_url(__DIR__) . 'linha-content-iframe/');
define('LA_C_IFRAME_UPLOAD_PATH', wp_upload_dir()['basedir'] . "/content-iframe");
define('LA_C_IFRAME_OPTION', 'la_c_iframes_list');

require_once LA_C_IFRAME_PATH . "load.php";