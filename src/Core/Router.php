<?php

namespace App\Core;
class Router{
    public Request $request;
    protected array $routes=[];

    public function __construct(Request $request){
        $this->request=$request;
    }
    
    public function get($path,$callback){
        $this->routes['GET'][$path]=$callback;
        
    }
    public function post($path,$callback){
        $this->routes['POST'][$path]=$callback;
        var_damp($callback);
    }

    public function resolve(){
        $path=$this->request->getPath();
        $method=$this->request->getMethod();
        $callback=$this->routes[$method][$path] ?? false;
        
       if ($callback===false){
        echo "404";
        exit;
       }
       call_user_func($callback);
    }
}