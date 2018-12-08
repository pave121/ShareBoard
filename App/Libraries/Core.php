<?php

/*
    * App core class
    * Creates URL and loads core controller
    * URL format - /controller/method/params
*/

class Core{
    
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];
    
    public function __construct(){
        
        //print_r($this->getUrl());
        $url = $this->getUrl();
        
        //look in controllers for first value
        if(file_exists('../App/Controllers/' . ucwords($url[0]) . '.php')){
            
            //if exists set as controller
            $this->currentController = ucwords($url[0]);
            //unset 0 Index
            unset($url[0]);
        }
        
        //require controller
        require_once '../App/Controllers/' . $this->currentController . '.php';
        
        //instatiate current controller
        $this->currentController = new $this->currentController;
        
        //chech for second part of URL (method)
        if(isset($url[1])){
            
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
            
        }
        
        //get params
        $this->params = $url ? array_values($url) : [];
        
        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        
    }
    
    public function getUrl(){
        
        if(isset($_GET['url'])){
            
            //strip ending / and sanitize URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            
            $url = explode('/', $url);
            
            return $url;
        }
    }
    
}