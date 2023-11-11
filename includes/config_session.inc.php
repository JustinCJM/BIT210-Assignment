<?php

ini_set('session.use_only_cookies', 1);
ini_set ('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime' => 3600,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => 'true',
    'httponly' => true
]);

session_start();

if(isset($_SESSION["user_username"])) {

    if(!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    
    } else {
        $interval = 60 * 60;
        if(time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }

} else {
    if(!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    
    } else {
        $interval = 60 * 60;
        if(time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id_loggedin() {

    $userID_Name = $_SESSION["user_username"];
    $newSessionID = session_create_id();
    $sessionID = $newSessionID . "_" . $userID_Name;
    session_id($sessionID);

    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}