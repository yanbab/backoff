<?php

function datetime2timestamp($str) {

    list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);
    
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    
    return $timestamp;
} 

function helper_date($datetime) {

    if($datetime=='0000-00-00 00:00:00') {
        return '';
    }
    $months = array("jan.", "fév.", "mars","avril", "mai" ,"juin","juil." , "août", "sept.", "oct.", "nov." , "déc.");
    $stamp = datetime2timestamp($datetime);
    $day = date ( "j",$stamp);
    $month = date ( "n",$stamp) - 1;
    $month = $months[$month];
    $year = date ("Y",$stamp);
    if($year == date("Y")) {
        $year = '';
    }
    return "$day $month $year";
    
}

function load_date($expo) {
  if($expo['id_type']==1) {
        $start = helper_date($expo['start']);
        $end   = helper_date($expo['end']);
        $expo['date']  = "du $start au $end ";
        
    }
    if($expo['id_type']==2) {
        $expo['date'] = 'Expo permanente';
    }
    if($expo['id_type']==3) {
        $start = helper_date($expo['start']);
        $hour  = substr($expo['start'],11,5);
        if($hour!="00:00") {
            $h = "à $hour";
        }
        $expo['date'] = "le $start $h";
    }
    return $expo;
}

$expos = db_get("SELECT * FROM agenda WHERE (start < NOW() AND end > DATE_SUB(NOW(),INTERVAL 2 DAY)) OR start = '0000-00-00 00:00:00' OR (start > NOW() AND end = '0000-00-00 00:00:00') OR ( end > DATE_SUB(NOW(),INTERVAL 2 DAY) AND id_type=1) ORDER BY id_type DESC, start");
foreach($expos as $key => $expo) {
    $expo = load_date($expo);
    $expos[$key] = $expo;
}


$arg=urldecode($arg);
$artiste = db_fetch(db_query("SELECT * FROM agenda WHERE artist like '$arg'"));
$galery = array();
if($artiste['id']) {
    $galery = db_get("SELECT * FROM galery WHERE id_agenda = '$artiste[id]'");
    $artiste = load_date($artiste);
}

