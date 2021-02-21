<?php
    //load libraries
//    require_once 'libraries/Core.php';
//    require_once 'libraries/Controller.php';
//    require_once 'libraries/Database.php';

    //autoloader core libraries cara kerjanya ialah controller harus sama dengan nama kelasnya
    spl_autoload_register(function ($className){
     require_once 'libraries/' .$className . '.php';
    });

    //load config
    require_once 'config/config.php';
    //load helper
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';


















?>

