<?php
    /**
     * RQO - Responsive Quick Objective Server
     * 
     * +-------------LICENSE-WARNING-------------+
     * | This Program is Licensed under MIT, We  |
     * | included a copy of it. The file name is |
     * | "LICENSE", if you did not recieve that, |
     * | you could look up on the World-Wide-Web.|
     * +-----------------------------------------+
     * 
     * USE IT UNDER THE LICENSE AND THE LAW !
     * 
     * @package RQO
     * @license MIT
     * @author xtl <xtl@xtlsoft.top>
     * 
     */
    
    // Require the Composer Autoload
    require "vendor/autoload.php";
    
    // Require the RQO autoload file
    require "Rqo/Autoload.php";
    
    // Judge the SAPI Name
    if(php_sapi_name() != "cli"){
        die("RQO Could Only Run In CLI SAPI!\r\n");
    }
    
    // Init the EventLoop
    \Rqo\Application::init();
    
    // Define The Application Directory
    $AppDir = __DIR__ . '/Application/';

    @include_once($AppDir.'Configure.php');
    
    // Include All The Files Under Application Directory
    foreach(\XDO\Tool::listDir($AppDir, 0) as $v){
        // Make sure it's an Application
        if(is_dir($AppDir . $v) && is_file($AppDir . $v . "/Application.php")){
            include $AppDir . $v . "/Application.php";
        }
    }
    
    // Run All the Applications
    \Rqo\Application::run();