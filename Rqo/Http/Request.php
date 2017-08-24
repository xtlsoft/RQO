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
    
    class Request {
        
        /**
         * Orgin Request Object
         * 
         * @var $orgin
         * 
         */
        public $orgin;
        
        /**
         * Request Method
         * 
         * @var $method
         * 
         */
        public $method;
        
        /**
         * Request Uri
         * 
         * @var $path
         * 
         */
        public $path;
        
        /**
         * Http host
         * 
         * @var $host
         * 
         */
        public $host;
        
        /**
         * Query String
         * 
         * @var $queryString
         * 
         */
        public $queryString;
        
        /**
         * Query Data
         * 
         * @var $query
         * 
         */
        public $query;
        
        /**
         * cookie
         * 
         * @var $cookie
         * 
         */
        public $cookie;
        
        /**
         * server
         * 
         * @var $server
         * 
         */
        public $server;
        
        /**
         * Post Orgin Data
         * 
         * @var $data
         * 
         */
        public $data;
        
        /**
         * Post Array
         * 
         * @var $post
         * 
         */
        public $post;
        
        /**
         * Variables in Path
         * 
         * @var $vars;
         * 
         */
        public $vars;
        
        /**
         * Constructor
         * 
         * @param \Psr\Http\Message\ServerRequestInterface
         * 
         * @return void
         * 
         */
        public function __construct($req, $data="", $vars=[]){
            
            $this->orgin = $req;
            $uri = $req->getUri();
            $this->host = $uri->getHost();
            $this->path = urldecode($uri->getPath());
            $this->queryString = $uri->getQuery();
            $this->method = $req->getMethod();
            
            $this->query = $req->getQueryParams();
            $this->cookie = $req->getCookieParams();
            $this->server = $req->getServerParams();
            
            parse_str($data, $this->post);
            $this->data = $data;
            $this->vars = $vars;
            
        }
        
    }