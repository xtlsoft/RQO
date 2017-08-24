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
    
    namespace Rqo\Http\Route;
    
    class AddrParseResult {
        
        /**
         * Keys
         * 
         * @var $keys
         * 
         */
        public $keys;
        
        /**
         * Regex
         * 
         * @var $preg;
         * 
         */
        public $preg;
        
        /**
         * Assign Result.
         * 
         * @param array The result.
         * 
         * @return \Rqo\Http\Route\AddrParseResult
         * 
         */
        public function assign($arr){
            
            $this->keys = $arr['keys'];
            $this->preg = $arr['preg'];
            
            return $this;
            
        }
        
    }