<?php

declare(strict_types = 1);

function get_username(object $mysqli, string $username): bool {
    $query = "SELECT username FROM customer WHERE username = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    $username_exists = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $username_exists;
}

function get_email(object $mysqli, string $email): bool {

    $query = "SELECT email FROM customer WHERE email = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    $email_exists = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $email_exists;
}

function set_user(object $mysqli, string $username, string $fullname, string $pwd, string $gender, string $email, int $contactno) {
    $query = "INSERT INTO customer (username, fullName, pwd, gender, email, contactno) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssssi", $username, $fullname, $pwd, $gender, $email, $contactno);
    $stmt->execute();    
    $stmt->close();
}
