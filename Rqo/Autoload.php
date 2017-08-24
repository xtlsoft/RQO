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
    
    namespace Rqo;
    
    defined("RQO_VERSION") or define("RQO_VERSION", "v0.1.0-alpha");
    
    class Autoload {
        
        /**
         * Load a file
         * 
         * @param string The name of the class.
         * 
         * @return mixed
         * 
         */
        public static function load($name){
            
            if(substr($name, 0, 4) == "Rqo\\"){
                
                $name = substr($name, 4);
                
                $name = str_replace("\\", "/", $name);
                
                return self::safeRequire( __DIR__ . '/' . $name . ".php" );
                
            }
            
        }
        
        /**
         * Require a file safely
         * 
         * @param string Filename
         * 
         * @return mixed
         * 
         */
        public static function safeRequire($file){
            
            if(is_file($file)){
                return require_once $file;
            }else{
                return false;
            }
            
        }
        
    }
    
    spl_autoload_register("\\Rqo\\Autoload::load");