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
    
    namespace Rqo\CLI;
    
    class stdio {
        
        protected $stdin;
        protected $stdout;
        protected $stderr;
        
        public function __construct(){
            $this->stdin = fopen("php://stdin", "r");
            $this->stdout = fopen("php://stdout", "w");
            $this->stderr = fopen("php://stderr", "w");
        }
        
        public function in(){
            return trim(fgets($this->stdin));
        }
        
        public function out($msg){
            return fwrite($this->stdout, $msg);
        }
        
        public function err($msg){
            return fwrite($this->stderr, $msg);
        }
        
    }