<?php
session_start();
if (isset($_SESSION["user_id"])){
    if(!isset($_SESSION["last_generation"])){
        regenerate_session_id_logged();
    } else {
        $interval - 60 * 30;
        if (time() -  $_SESSION["last_regeneration"] >= $interval){
            regenerate_session_id_logged();
        }
    }
}
if(!isset($_SESSION["last_generation"])){
    regenerate_session_id();
} else {
    $interval - 60 * 30;
    if (time() -  $_SESSION["last_regeneration"] >= $interval){
        regenerate_session_id();
    }
}
function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
} 
function regenerate_session_id_logged(){
    session_regenerate_id(true);
    $userid =$_SESSION["user_id"];
    $newsessionid = session_create_id();
    $sessionid = $newsessionid ."_" .  $userid;
    session_id($sessionid);
    $_SESSION["last_regeneration"] = time();
} 