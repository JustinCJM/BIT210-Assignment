<?php

declare(strict_types = 1);

function updateMerchantPassword(string $username, string $pwd, object $mysqli) {
    // Using prepared statement to prevent SQL injection
    $query = "UPDATE merchant SET pwd = ?, default_pwd = NULL, regStatus = 'ACTIVE' WHERE username = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ss", $pwd, $username);

        $stmt->execute();

        $stmt->close();
    }
}

function get_user(object $mysqli, string $oldPassword) {
    $query = "SELECT username, pwd,'merchant' AS user_type FROM merchant WHERE pwd = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $oldPassword);

    $stmt->execute();

    $result = $stmt->get_result();

    $user_info = [];
    while ($row = $result->fetch_assoc()) {
        $user_info[] = $row;
    }

    $stmt->close();

    return $user_info;
}

function does_password_match(object $mysqli, string $oldPassword): bool {
    $query = "SELECT pwd FROM merchant WHERE pwd = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $oldPassword);

    $stmt->execute();

    $result = $stmt->get_result();

    $password_matches = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $password_matches;
}

