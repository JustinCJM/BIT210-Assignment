<?php

require_once '../dbh.inc.php';
require_once 'update_password_model.inc.php';
require_once '../config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $errors = [];

    if ($newPassword !== $confirmPassword) {
        $errors["pwd_mismatch"] = "Passwords do not match!";
    }
    
    If ($oldPassword === $newPassword) {
        $errors["duplicate_pwd"] = "New password same as old password!";
    }

    if (!does_password_match($mysqli, $oldPassword)) {
        $errors["existing_pwd"] = "Incorrect old password!";
    }

    if (!empty($errors)) {
        $_SESSION["error_pwd"] = $errors;
        header("Location: ../../update_password.php");
        die();
    }

    $user_info = get_user($mysqli, $oldPassword);

    $_SESSION["user_username"] = $user_info[0]["username"];

    updateMerchantPassword($_SESSION['user_username'], $newPassword, $mysqli);

    $newSessionID = session_create_id();
    $sessionID = $newSessionID . "_" . $user_info[0]["username"];
    session_id($sessionID);

    $_SESSION["last_regeneration"] = time();

    header("Location: ../../index.php");
            die();
    
            $mysqli = null;
            $stmt = null;
}