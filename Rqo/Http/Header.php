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
    
    namespace Rqo\Http;
    
    class Header {
        
        /**
         * The headers
         * 
         * @var $header
         * 
         */
        protected $header = [
                "content-type" => "text/html",
                "Server" => "Rqo&ReactPHP"
            ];
        
        /**
         * Constructor
         * 
         * @param array The headers.
         * 
         * @return void
         * 
         */
        public function __construct($arr = []){
            
            $this->header = array_merge($this->header, $arr);
            
            return $this;
            
        }
        
        /**
         * Set a header
         * 
         * @param string name
         * @param string value
         * 
         * @return \Rqo\Http\Header
         * 
         */
        public function set($name, $value){
            
            $this->header[$name] = $value;
            
            return $this;
            
        }
        
        /**
         * Dump the headers
         * 
         * @return array
         * 
         */
        public function dump(){
            
            return $this->header;
            
        }
        
    }