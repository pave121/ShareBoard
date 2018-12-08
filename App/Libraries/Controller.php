<?php

/*
    *core controller class
    *loads models and views
    
*/

class Controller{
    
    //load model
    public function model($model){
        
        //require model file
        require_once '../App/Models/' . $model . '.php';
        
        //instantiate the model
        return new $model();
    }
    
    //load view and pass data to view
    public function view($view, $data = []){
        
        //check for view file
        if(file_exists('../App/Views/' . $view . '.php')){
            require_once '../App/Views/' . $view . '.php';
        }
        else{
            require_once '../App/Views/404/404.php';
        }
    }
}
