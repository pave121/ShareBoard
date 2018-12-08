<?php

class Pages extends Controller{
    
    public function __construct(){
        
    
        
    }
    
    public function index(){
        
        $data = [
            'title' => 'ShareBoard',
            'description' => 'Simple social network built on MyMVC PHP Framework'
        ];
        
        
        $this->view('Pages/index', $data);
        
    }
    
    public function about(){
        
        $data = [
            'title' => 'About',
            'description' => 'App to share posts with other users'
        ];
        
        $this->view('Pages/about', $data);
    }
}