<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../dbh.inc.php';
    require_once 'custsignup_model.inc.php';
    require_once 'custsignup_contr.inc.php';
    require_once '../config_session.inc.php';
    
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $pwd = $_POST["password"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $contactno = $_POST["contactno"];

    $errors = [];

    // if(!is_contactno_valid($contactno)) {
    //     $errors["invalid_number"] = "Contact Number must be numbers!";
    // }
    if(is_input_empty($username, $fullname, $pwd, $gender, $email, $contactno)) {
        $errors["empty_input"] = "Fill in all fields!";
    }
    if(is_email_invalid($email)) {
        $errors["invalid_email"] = "Invalid email used!";
    }
    if(is_username_taken($mysqli, $username)) {
        $errors["taken_username"] = "Username is already taken!";
    }
    if(is_email_registered($mysqli, $email)) {
        $errors["taken_email"] = "Email is already registered!";
    }

    if (!empty($errors)) {
        $_SESSION["error_signup"] = $errors;
        $signupData = [
            "username" => $username,
            "fullname" => $fullname,
            "gender" => $gender,
            "email" => $email,
            "contactno" => $contactno
        ];
        $_SESSION["signup_data"] = $signupData;
        header("Location: ../../cust_registration.php");
        die();
    }

    create_user($mysqli, $username, $fullname, $pwd, $gender, $email, $contactno);

    header("Location: ../../signupsuccess.php");
    die();

    $mysqli = null;
    $stmt = null;

} else {
    header("Location: ../../cust_registration.php");
    die();
}