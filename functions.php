<?php 

define('DBINFO','mysql:host=localhost;dbname=m');
define('DBUSER','root');
define('DBPASS','');

function performQuery($query){
    $con = new PDO(DBINFO,DBUSER,DBPASS);
    $stmt = $con->prepare($query);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function fetchAll($query){
    $con = new PDO(DBINFO,DBUSER,DBPASS);
    $stmt = $con->query($query);
    return $stmt->fetchAll();
}

function endsWith($letter, $string){
    return str_split($string)[strlen($string) - 1] == $letter;
}

function toPlural($string){
    $final = $string."s";
    if(endsWith('s',$string)){
        $final = $string."es";
    }
    return $final;
}

function snakeCaseToWords($string){
    return ucwords(str_replace("_"," ",$string));
}


?>