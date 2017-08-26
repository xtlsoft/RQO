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

    class Json {

        /**
         * Json Content
         *
         * @var mixed[]
         * 
         */
        public $array = [];

        /**
         * Constructor
         *
         * @param mixed $json
         * 
         */
        public function __construct($json){

            return $this->import($json);

        }

        /**
         * Import A Json
         *
         * @param mixed $json
         * 
         * @return self
         * 
         */
        public function import($json){

            if(!is_array($json)){
                $json = json_decode($json, 1);
            }

            $this->array = array_merge($this->array, $json);

            return $this;

        }

        /**
         * Get A Value
         *
         * @param string $name
         * 
         * @return mixed
         * 
         */
        public function __get($name){

            if($name === "json"){
                return json_encode($this->array);
            }

            return $this->array[$name];

        }

        /**
         * Set A Value
         *
         * @param string $name
         * @param mixed $value
         * 
         * @return void
         * 
         */
        public function __set($name, $value){

            $this->array[$name] = $value;

        }

        /**
         * To String
         *
         * @return string
         * 
         */
        public function __toString(){

            return $this->json;

        }

    }