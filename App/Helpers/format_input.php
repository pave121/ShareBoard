<?php

function prepareInput(){
    
    $values = ['name', 'email', 'password', 'confirm_password'];
    
    foreach ($values as $value){
        
        if(isset($_POST[$value])){
            sanitize($_POST[$value]);
        }
    }
}


function sanitize($input){
    
    $input = trim($input);
    
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


function verifyLoginData(){
        
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