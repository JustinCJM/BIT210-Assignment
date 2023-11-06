<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["password"];

    require_once '../dbh.inc.php';
    require_once 'login_model.inc.php';
    require_once 'login_contr.inc.php';
    require_once '../config_session.inc.php';

    $errors = [];
    
    if (is_input_empty($username, $pwd)) {
        $errors["empty_input"] = "Fill in all fields!";
    }

    if (!does_username_exist($mysqli, $username)) {
        $errors["existing_username"] = "Username does not exist!";
    }

    if (does_username_exist($mysqli, $username) && !check_password($mysqli, $username, $pwd)) {
        $errors["wrong_password"] = "Password is incorrect!";
    }

    if (!empty($errors)) {
        $_SESSION["error_login"] = $errors;
        header("Location: ../../login.php");
        die();
    }

    $user_info = get_user($mysqli, $username);

    if (!empty($user_info)) {
        $_SESSION['user_type'] = $user_info[0]['user_type'];
    }

    $userType = $_SESSION["user_type"] ?? null;
    if (($userType === 'tourism_ministry_officer')) {

        
        $newSessionID = session_create_id();
        $sessionID = $newSessionID . "_" . $user_info[0]["username"];
        session_id($sessionID);

        $_SESSION["user_username"] = $user_info[0]["username"];

        $_SESSION["last_regeneration"] = time();

        header("Location: ../../reviewMerchant.php");
        die();

        $mysqli = null;
        $stmt = null;

    } else {
        
    $newSessionID = session_create_id();
    $sessionID = $newSessionID . "_" . $user_info[0]["username"];
    session_id($sessionID);

    $_SESSION["user_username"] = $user_info[0]["username"];

    $_SESSION["last_regeneration"] = time();

    header("Location: ../../index.php");
    die();

    $mysqli = null;
    $stmt = null;

    }



    } else {
        header("Location: ../login.php");
        die();
}
    