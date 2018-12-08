<?php
    //load config
    require_once 'config/config.php';
    //load Helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    // Autoload Core Lib
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });