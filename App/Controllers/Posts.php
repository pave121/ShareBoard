<?php

class Posts extends Controller{
    
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect('Users/login');
        }
        
        $this->postModel = $this->model('Post');
    }
    
    public function index(){
        $posts = $this->postModel->getPosts();
        
        //array of objects
        $data = [
            'posts' => $posts
        ];
        
        $data = formatDate($data);
        
        $this->view('Posts/index', $data);
    }
}