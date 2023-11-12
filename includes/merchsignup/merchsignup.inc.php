<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../dbh.inc.php';
    require_once 'merchsignup_model.inc.php';
    require_once 'merchsignup_contr.inc.php';
    require_once '../config_session.inc.php';
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $contactno = $_POST["contactno"];
    $shopname = $_POST["shopname"];
    $shopdescription = $_POST["shopdescription"];
    $docdescription = $_POST["filedescription"];

    $errors = [];

    if(is_input_empty($username, $email, $contactno, $shopname, $shopdescription, $docdescription)) {
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
    if(is_shopName_registered($mysqli, $shopname)) {
        $errors["taken_shopName"] = "Shop name is already taken!";
    }

    if (!empty($errors)) {
        $_SESSION["error_signup"] = $errors;
        $signupData = [
            "username" => $username,
            "shopname" => $shopname,
            "email" => $email,
            "contactno" => $contactno,
            "shopdescription" => $shopdescription
        ];
        $_SESSION["signup_data"] = $signupData;
        header("Location: ../../merch_registration.php");
        die();
    }

    create_user($mysqli, $username, $email, $contactno, $shopname, $shopdescription);

    $merchantID = $mysqli->insert_id;

    if (isset($_POST['submit'])) {
        $uploadDirectory = '../../pdfuploads/';
        $downloadDirectory = 'pdfuploads/';

        $uniqueFilename = $username . "_" . basename($_FILES["pdfdoc"]["name"]);
        $uploadPath = $uploadDirectory . $uniqueFilename;
        $targetPath = $downloadDirectory . $uniqueFilename;

        if (move_uploaded_file($_FILES["pdfdoc"]["tmp_name"], $uploadPath)) {
            insertDocument($mysqli, $merchantID, $uniqueFilename, $targetPath, $docdescription);
        } else {
            $errors["upload_error"] = "Failed to move the uploaded file.";
        }
    }

    header("Location: ../../merchant_signupsuccess.php");
    die();

    $mysqli = null;
    $stmt = null;

} else {
    header("Location: ../../merch_registration.php");
    die();
}