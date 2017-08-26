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

    namespace Rqo\Fs;

    class Directory {

        /**
         * Base Directory
         *
         * @var string
         * 
         */
        protected $base;

        /**
         * Constructor
         *
         * @param string $basedir (__DIR__)
         * 
         * @return void
         * 
         */
        public function __construct($basedir){

            $this->base = $basedir;

        }

        /**
         * Get File Content
         *
         * @param string $file
         * 
         * @return mixed
         * 
         */
        public function getContent($file){

            return file_get_contents($this->base . '/' . $file);

        }

        /**
         * Put File Content
         *
         * @param string $file
         * @param mixed $data
         * 
         * @return void
         * 
         */
        public function putContent($file, $data){

            return file_put_contents($this->base . '/' . $file, $data);

        }
        
        /**
         * List The Directory
         *
         * @param string $dir
         * 
         * @return string[]
         */
        public function list($dir = ""){

            return \XDO\Tool::listDir($this->base . '/' . $dir, 0);

        }
        
        /**
         * File Factory
         *
         * @param string $file
         * 
         * @return \Rqo\Fs\File
         * 
         */
        public function factory($file, $mode="a+"){

            return new \Rqo\Fs\File($this->base . '/' . $file, $mode);

        }

    }