<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd) {
    if(empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function check_password(object $mysqli, string $username, string $pwd) {
    $user_info = get_user($mysqli, $username);

    if (empty($user_info)) {
        return false;
    } else {
        $stored_password = $user_info[0]['pwd'];

        if ($pwd === $stored_password) {
            return true;
        } else {
            return false;
        }
    }
}

function comparePasswords(object $mysqli, $username) {
    $passwords = getPasswordsByUsername($mysqli, $username);
    
    return $passwords['pwd'] === $passwords['default_pwd'];
}