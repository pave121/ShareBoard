<?php

class Posts extends Controller{
    
    public function __construct(){
        
        if(!isLoggedIn()){
            redirect('Users/login');
        }
        
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    
    public function index(){
        $posts = $this->postModel->getPosts();
        
        //array of objects
        $data = [
            'posts' => $posts
        ];
        
        foreach($data['posts'] as $post){
            
            $post->postCreated = formatDate($post->postCreated);
        }
        
        $this->view('Posts/index', $data);
    }
    
    public function add(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' =>$_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
        ];
            
            if(empty($data['title'])){
                $data['title_err'] = "Please enter title";
            }
            
            if(empty($data['body'])){
                $data['body_err'] = "Please fill in the body";
            }
            
            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('Posts');
                }
                else{
                    die("Something went wrong");
                }
            }
            else{
                $this->view('Posts/add', $data);
            }
        }
        else{
        
        $data = [
            'title' => '',
            'body' => ''
        ];
        
        $this->view('Posts/add', $data);
        }
    }
    
    public function show($id){
        
        
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];
        
        $data['post']->created_at = formatDate($data['post']->created_at);
        
        
        $this->view('Posts/show', $data);
        
    }
    
    public function edit($id){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' =>$_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
        ];
            
            if(empty($data['title'])){
                $data['title_err'] = "Please enter title";
            }
            
            if(empty($data['body'])){
                $data['body_err'] = "Please fill in the body";
            }
            
            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('Posts');
                }
                else{
                    die("Something went wrong");
                }
            }
            else{
                $this->view('Posts/edit', $data);
            }
        }
        else{
            
            $post = $this->postModel->getPostById($id);
            
            if($post->user_id != $_SESSION['user_id']){
                redirect('Posts');
            }
        
        $data = [
            'id' => $id,
            'title' => $post->title,
            'body' => $post->body
        ];
        
        $this->view('Posts/edit', $data);
        }
    }
    
    public function delete($id){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $post = $this->postModel->getPostById($id);
            
            if($post->user_id != $_SESSION['user_id']){
                redirect('Posts');
            }
            
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Post Removed');
                redirect('Posts');
            }
            else{
                die('Something went wrong');
            }
        }
        else{
            redirect('Posts');
        }
    }
}


























