<?php


$files = array(
    'function.php',
    'enqueue.php',

    'admin/register.php',
    'admin/render.php',
    'admin/save.php'
);


foreach ($files as $file) {
    require_once LA_C_IFRAME_PATH . 'inc/' . $file;
}
