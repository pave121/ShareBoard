<?php

//page redirect

function redirect($page){
    
    header('Location: ' . URL_ROOT . '/' . $page);
}