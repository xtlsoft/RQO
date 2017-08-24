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
    
    class Route {
        
        /**
         * Routers
         * 
         * @var $route
         * 
         */
        protected $route = [];
        
        /**
         * Register A Handle
         * 
         * @param string $method
         * @param string $addr
         * @param callable $callback
         * 
         * @return \Rqo\Http\Route
         * 
         */
        public function on($method, $addr, callable $callback){
            
            $rslt = self::parseAddr($addr);
            
            if(! ($rslt instanceof \Rqo\Http\Route\AddrParseResult) ){
                throw new \Exception("Route Expecting \Rqo\Http\Route\AddrParseResult, Other Given.");
            }
            
            $route = ["method"=>$method, "keys"=>$rslt->keys, "preg"=>$rslt->preg, "callback"=>$callback];
            
            $this->route[] = $route;
            
            return $this;
            
        }
        
        /**
         * Handle A Request
         * 
         * @param string $method
         * @param string $addr
         * 
         * @return \Rqo\Http\Response 
         * 
         */
        public function handle($method, $addr){
            
            $method = strtolower($method);
            
            foreach($this->route as $v){
                
                if($v['method'] == $method){
                    
                    $rslt = self::comparePregAndPath($v['preg'], $addr);
                    
                    if($rslt){
                        
                        $vars = self::toAssocByKeyAndValue($v['keys'], $rslt);
                        
                        $callback = $v['callback'];
                        
                        return ["vars"=>$vars, "callback"=>$callback];
                        
                    }
                    
                }
                
            }
            
            // When 404
            return [
                    "vars" => [],
                    "callback" => function(\Rqo\Http\Request $req){
                    
                        return (
                                (new \Rqo\Http\Response(404))->
                                    header( (new \Rqo\Http\Header())->set("status", "Not Found") )->
                                    write("<html><head><meta charset=\"utf-8\" /><title>404 Not Found</title></head>")->
                                    write("<body><h1 align=\"center\">404 Not Found</h1><p align=\"center\">Request URI: ")->
                                    write($req->path)->
                                    write("</p><hr /><p align=\"center\"><i>Server: Rqo/")->
                                    write(RQO_VERSION)->
                                    write("</i></p></body></html>")
                            );
                    
                    }
                ];
        }
        
        /**
         * Call Func(Register)
         * 
         * @param string Method
         * @param array Parameters
         * 
         * @return mixed
         * 
         */
        public function __call($name, $param){
            
            return $this->on($name, $param[0], $param[1]);
            
        }
        
        /**
         * Parse A Route Addr
         * 
         * @param string $addr
         * 
         * @return \Rqo\Http\Route\AddrParseResult
         * 
         */
        public static function parseAddr($addr){
            
            $key = [];
            
            // if(str_replace("{","",$addr) == $addr){
            //     $addr = "/".str_replace(array("/", "."), array("\\/", "\\."), $addr)."/";
            //     return (new \Rqo\Http\Route\AddrParseResult())->assign(["keys"=>[], "preg"=>$addr]);
            // }
            
            // Dump the keys & Replacement
            $preg = preg_replace_callback("/\\{[a-zA-Z]*\\}/", function($a) use (&$key){
                $key[] = substr($a[0], 1, -1);
                return "<<<>>>";
            }, $addr);
            
            // Generate The Regex 
            $preg = "/^".str_replace(array("/", ".", "<<<>>>"), array("\\/", "\\.", "(.*)"), $preg)."$/";
            
            return (new \Rqo\Http\Route\AddrParseResult())->assign(["keys"=>$key, "preg"=>$preg]);
            
        }
        
        /**
         * Compare And Work Out The Vars
         * 
         * @param string Regex
         * @param string Addr
         * 
         * @return bool/array
         * 
         */
        public static function comparePregAndPath($preg, $addr){
            
            $rslt = [];
            
            if(preg_match($preg, $addr, $rslt)){
                unset($rslt[0]);
                if(!$rslt){
                    $rslt = ["____"];
                }
                return $rslt;
            }else{
                return false;
            }
            
        }
        
        /**
         * Get Assoc By Keys And Values
         * 
         * @param string[] $key
         * @param string[] $value
         * 
         * @return string[]
         * 
         */
        public static function toAssocByKeyAndValue($key, $value){
            
            $rslt = [];
            
            foreach($value as $k=>$v){
                
                if(isset($key[$k-1])){
                    $rslt[$key[$k-1]] = urldecode($v);
                }
                
            }
            
            return $rslt;
            
        }
        
    }