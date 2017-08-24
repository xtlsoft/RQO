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
    
    class Response {
        
        /**
         * Status code
         * 
         * @var $status
         * 
         */
        public $status = 200;
        
        /**
         * Headers
         * 
         * @var $header
         * 
         */
        public $header = [];
        
        /**
         * Content
         * 
         * @var $content
         * 
         */
        public $content = "";
        
        /**
         * Constructor
         * 
         * @param int statusCode
         * 
         * @return void
         * 
         */
        public function __construct($code=200){
            
            $this->status = $code;
            
        }
        
        /**
         * Set Header
         * 
         * @param \Rqo\Http\Header The Header Object.
         * 
         * @return \Rqo\Http\Response
         * 
         */
        public function header(\Rqo\Http\Header $header){
            
            $this->header = $header->dump();
            
            return $this;
            
        }
        
        /**
         * Write Result to Buffer
         * 
         * @param string The Data
         * 
         * @return \Rqo\Http\Response
         * 
         */
        public function write($data){
            
            $this->content .= $data;
            
            return $this;
            
        }
        
        /**
         * Dump the data
         * 
         * @return \Rqo\Http\Response
         * 
         */
        public function dump(){
            
            return $this;
            
        }
        
    }