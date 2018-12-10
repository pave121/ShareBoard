<?php 

function formatDate($data = []){
    
    foreach ($data['posts'] as $post){
        
        $date_time = strtotime($post->postCreated);
        
        $post->postCreated = date('d.m.Y. H:i', $date_time);
        
    }
        return $data;
}