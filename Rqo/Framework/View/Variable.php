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

    namespace Rqo\Framework\View;

    class Variable {

        /**
         * Variables
         *
         * @var mixed[]
         * 
         */
        protected $vars = [];

        /**
         * Constructor
         *
         * @param string[] $arr
         * 
         * @return void
         * 
         */
        public function __construct($arr = []){

            return $this->importFromArray($arr);

        }

        /**
         * importFromArray
         * 
         * @param string[] $arr 
         * 
         * @return self
         * 
         */
        protected function importFromArray($arr){

            $this->vars = array_merge($this->vars, $arr);

            return $this;

        }

        /**
         * Set a Variable
         *
         * @param string|string[] $key
         * @param string $value
         * 
         * @return self
         * 
         */
        public function set($key, $value = ""){

            if(is_array($key)){
                return $this->importFromArray($key);
            }

            $this->vars[$key] = $value;

            return $this;

        }

        /**
         * Dump the variables
         *
         * @return mixed[]
         * 
         */
        public function dump(){

            return $this->vars;

        }

    }