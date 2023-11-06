<?php

declare(strict_types = 1);

function is_input_empty(string $username, string $email, string $contactno, string $shopname, string $shopdescription, string $docdescription) {
    if(empty($username) || empty($email) || empty($contactno) 
    || empty($shopname) ||empty($shopdescription) || empty($docdescription)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $mysqli, string $username) {
    if(get_username($mysqli, $username)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $mysqli, string $email) {
    if(get_email($mysqli, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_shopName_registered(object $mysqli, string $shopname) {
    if(get_shopName($mysqli, $shopname)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $mysqli, string $username, string $email, string $contactno, string $shopname, string $shopdescription) {
    set_user($mysqli, $username, $email, $contactno, $shopname, $shopdescription);
}

function insertDocument(object $mysqli, $merchantID, string $uniqueFilename, string $targetPath, string $docdescription) {
    setDocument($mysqli, $merchantID, $uniqueFilename, $targetPath, $docdescription);
}