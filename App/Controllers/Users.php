<?php

class Users extends Controller{
    
    public function __construct(){
       $this->userModel = $this->model('User'); 
        
    }
    
    public function register(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $data = $this->verifyRegisterData();
            
        if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            
            die ("SUCCESS");
        }
        else{
            $this->view('users/register', $data);
        }
            
        }else{
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            $this->view('users/register', $data);
        }
    }
    
    public function login(){
        //check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $data = $this->verifyLoginData();
            
             if(empty($data['email_err']) && empty($data['password_err'])){
            
            die ("SUCCESS");
        }
        else{
            $this->view('users/login', $data);
        }
            
        }else{
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            
            $this->view('users/login', $data);
        }
    }
    
    private function verifyRegisterData(){
        
        $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
        
        $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
        
        if(empty($data['email'])){
                $data['email_err'] = "Please enter email";
            }
        
        else{
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = "Email is already taken";
            }
            
        }
        
        if(empty($data['name'])){
                $data['name_err'] = "Please enter name";
            }
        if(empty($data['password'])){
                $data['password_err'] = "Please enter password";
            }
        elseif(strlen($data['password']) < 6 ){
                $data['password_err'] = "Password must be at least 6 characters";
            }
        if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = "Please confirm password";
            }
        else{
            if($data['password'] !=                 $data['confirm_password']){
                $data['confirm_password_err'] = "Passwords do not match";
            }
        }
        
        return $data;
        
        
    }
    
    private function verifyLoginData(){
        
         $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
        
        $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
        
        if(empty($data['email'])){
                $data['email_err'] = "Please enter email";
            } 
        

        if(empty($data['password'])){
                $data['password_err'] = "Please enter password";
            }
        
        if($user = $this->userModel->findUserByEmail($data['email'])){
            if($data['password'] == $user->password){
                echo "Success";
            }
        }
            
        
        
        return $data;
    }
    
    
}