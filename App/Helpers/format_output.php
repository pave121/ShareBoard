<?php 

function formatDate($data = []){
    
    foreach ($data['posts'] as $post){
        
        $date_time = strtotime($post->postCreated);
        
        switch (date('l', $date_time)){
            case 'Monday':
                $day = 'Ponedjeljak';
                break;
            case 'Tuesday':
                $day = 'Utorak';
                break;
            case 'Wednesday':
                $day = 'Srijeda';
                break;
            case 'Thursday':
                $day = 'Četvrtak';
                break;
            case 'Friday':
                $day = 'Petak';
                break;
            case 'Saturday':
                $day = 'Subota';
                break;
            case 'Sunday':
                $day = 'Nedjelja';
                break;
                
        }
        
        $post->postCreated = $day .', ' . date('d.m.Y. H:i', $date_time);
        
    }
        return $data;
}