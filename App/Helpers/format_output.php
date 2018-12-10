<?php 

function formatDate($date){
        
        $date_time = strtotime($date);
        
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
        
        $date = $day .', ' . date('d.m.Y. H:i', $date_time);
        
        return $date;
}