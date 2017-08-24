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
    
    class Application {
        
        /** Static Area **/
        
        /**
         * Application Array
         * 
         * @var $Applications
         * 
         */
        protected static $Applications = [];
        
        /**
         * The Task Scheduler
         * 
         * @var $Scheduler
         * 
         */
        protected static $Scheduler;
        
        /**
         * The EventLoop
         * 
         * @var $loop
         * 
         */
        public static $loop;
        
        /**
         * Add an Application into tasks queue.
         * 
         * @param \Rqo\Application $Application
         * 
         * @return void
         * 
         */
        public static function add(\Rqo\Application $Application){
            
            self::$Applications[] = $Application;
            
        }
        
        /**
         * Init the EventLoop
         * 
         * @return void
         * 
         */
        public static function init(){
            // Create STDIO Instance
            $stdio = new \Rqo\CLI\stdio();
            $stdio->out("-----------RQO Platform-----------\r\n");
            $stdio->out("RQO Version: ".RQO_VERSION."\r\n");
            
            // Create an EventLoop
            $stdio->out("Creating EventLoop... ");
            self::$loop = \React\EventLoop\Factory::create();
            $stdio->out("(ok)\r\n");
        }
        
        /**
         * Run the Applications
         * 
         * @return void
         * 
         */
        public static function run(){
            
            // Creating stdio Instance
            $stdio = new \Rqo\CLI\stdio();
            
            // Booting up
            $stdio->out("Booting up Servers... ");
            foreach(self::$Applications as $app){
                $app->bootup();
            }
            $stdio->out("(ok)\r\n");
            
            // Run The EventLoop
            $stdio->out("-----------------------------------\r\n");
            $stdio->out("Server Started Up, Ctrl+C to Quit\r\n");
            $stdio->out("Running EventLoop... ");
            self::$loop->run();
            $stdio->out("(Quit)\r\n");
            
        }
        
        /** Instance Area **/
        
        /**
         * HTTP Server
         * 
         * @var $server
         * 
         */
        public $server;
        
        /**
         * Socket
         * 
         * @var $socket
         * 
         */
        public $socket;
        
        /**
         * Router
         * 
         * @var $route
         * 
         */
        public $route;
        
        protected $addr;
        protected $context;
        
        /**
         * Constructor
         * 
         * @param string address
         * @param array context (useless now)
         * 
         * @return void
         * 
         */
        public function __construct($addr, $context = []){
            
            $this->addr = $addr;
            $this->context = $context;
            
        }
        
        /**
         * Booting up
         * 
         * @return void
         * 
         */
        public function bootup(){
            
            $addr = $this->addr;
            $context = $this->context;
            
            //Get the router.
            $route = $this->route;
            
            //Init the stdout.
            $stdio = new \Rqo\CLI\stdio;
            
            // Create A Server.
            $this->server = new \React\Http\Server( function(\Psr\Http\Message\ServerRequestInterface $request) use ($route, $stdio){
                
                return new \React\Promise\Promise(function ($resolve, $reject) use ($request, $route, $stdio){
                    
                    // Get From Router
                    $rdt = $route->handle($request->getMethod(), $request->getUri()->getPath());
                    $handle = $rdt['callback'];
                    $vars = $rdt['vars'];
                    
                    // Init the data.
                    $data = "";
                    
                    // On data
                    $request->getBody()->on('data', function($dt) use (&$data){
                        
                        // Merge the data
                        $data .= $dt;
                        
                    });
                    
                    // On End Data
                    $request->getBody()->on('end', function() use ($request, &$data, $handle, $vars, $resolve){
                        
                        // Getting message.
                        $resp = $handle(new \Rqo\Http\Request($request, $data, $vars));
                        
                        // Handle the Response.
                        if($resp instanceof \Rqo\Http\Response){
                            $response = new \React\Http\Response(
                                    $resp->dump()->status,
                                    $resp->dump()->header,
                                    $resp->dump()->content
                                );
                            $resolve($response);
                        }else{
                            throw new \Exception("Excepting return \\Rqo\\Http\\Response but other given.");
                        }
                        
                    });
                    
                    // On Error
                    $request->getBody()->on('error', function (\Exception $exception) use ($resolve, &$contentLength) {
                        $response = new Response(
                                400,
                                array('Content-Type' => 'text/plain'),
                                "An error occured while reading data."
                            );
                        $resolve($response);
                    });
                    
                });
                
            } );
            
            $this->server->on('error', function (\Exception $e) {
                echo PHP_EOL. 'Error: ' . $e->getMessage() . " in " . $e->getFile() . ' line '. $e->getLine() . PHP_EOL;
            });
            
            // Create A Socket.
            $this->socket = new \React\Socket\Server($addr, self::$loop);
            
            // Listen
            $this->server->listen($this->socket);
            
        }
        
        /**
         * Set the Handler
         * 
         * @param string (useless now)
         * @param Callable Handler
         * 
         * @return void
         * 
         */
        public function route(\Rqo\Http\Route $route){
            
            $this->route = $route;
            
        }
        
    }