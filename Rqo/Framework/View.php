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

    namespace Rqo\Framework;

    class View {

        /**
         * Content
         *
         * @var string
         * 
         */
        protected $content;

        /**
         * Constructor
         *
         * @param string $viewName
         * 
         * @return void
         * 
         */
        public function __construct($viewName){

            $this->content = (new \Rqo\Fs\Directory(_RQO_FRAMEWORK_VIEW_BASEDIR_)) -> getContent($viewName . ".html");
            
        }
        
        /**
         * Assign Variables
         *
         * @param \Rqo\Framework\View\Variable $var
         * 
         * @return \Rqo\Framework\View
         * 
         */
        public function assign(\Rqo\Framework\View\Variable $var){

            foreach($var->dump() as $k=>$v){
                $this->content = str_replace("\${".$k."}", $v, $this->content);
            }

            return $this;

        }

        /**
         * Get Content
         *
         * @return string
         * 
         */
        public function content(){

            return $this->content;

        }

        /**
         * To String
         *
         * @return string
         * 
         */
        public function __toString(){

            return $this->content();

        }

    }