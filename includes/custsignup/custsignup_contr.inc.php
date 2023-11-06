<?php

declare(strict_types = 1);

function is_input_empty(string $username, string $fullname, string $pwd, string $gender, string $email,$contactno) {
    if(empty($username) || empty($fullname) || empty($pwd) 
    || empty($gender) || empty($email) || $contactno === 0) {
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

// function is_contactno_valid($contactno) {
//     return is_int($contactno);
// }

function create_user(object $mysqli, string $username, string $fullname, string $pwd, string $gender, string $email, int $contactno) {
    set_user($mysqli, $username, $fullname, $pwd, $gender, $email, $contactno);
}
