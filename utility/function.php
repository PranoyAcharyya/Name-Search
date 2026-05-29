<?php

function e($value){
    return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
};

function generateAlphabets(){
    $start = ord('A');
    $end = ord('Z');
    $letters = [];
    
    for ($x=$start ; $x <= $end ; $x++){
            $letters[] = chr($x);
    }

    return $letters;

};



?>