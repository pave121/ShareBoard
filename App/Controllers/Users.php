<?php

/*
    Methods:
        - public construct
        
        -public register() -> sends data to model User->register
        
        -public login() -> asks model to check, and does the login
        
        -private verifyRegisterData() -> sanitize and checks register form data, returns it to register() method
        
        -private verifyLoginData() -> sanitize and checks login form data, returns it to register() method
        
        -public createUserSession($user) -> creates session when login data is verified
        
        -public logout() ->unsets the session
        
        -public isLoggedIn() -> returns true if session exists, false otherwise 
        
        uses helper functions from Helpers

*/

class Users extends Controller{
    
    public function __construct(){
       $this->userModel = $this->model('User'); 
        
    }
    
    public function register(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $data = $this->verifyRegisterData();
            
        if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
            if($this->userModel->register($data)){
                
                flash('register_success', 'You are now registered');
                redirect('Users/login');
            }
            else{
                
                die ("Something went wrong");
            }
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
            
                $loggedInUser = $this->userModel->login($data['email']);
                 
                // create session
                $this->createUserSession($loggedInUser);
                 
                 
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
            if(!password_verify($data['password'], $user->password)){
                $data['password_err'] = 'This user / password combination does not exist';
            }
        }
        else{
            $data['email_err'] = 'User with this email does not exist';
        }
            
        return $data;
    }
    
    public function createUserSession($user){
        
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        
        redirect('Posts');
        
    }
    
    public function logout(){
        
        unset ($_SESSION['user_id']);
        unset ($_SESSION['user_email']);
        unset ($_SESSION['user_name']);
        
        session_destroy();
        
        redirect('Users/login');
        
    }
    
   

    
}