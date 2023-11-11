<?php

declare(strict_types = 1);

function get_username(object $mysqli, string $username): bool {
    $query = "SELECT username FROM merchant WHERE username = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    $username_exists = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $username_exists;
}

function get_email(object $mysqli, string $email): bool {

    $query = "SELECT email FROM merchant WHERE email = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    $email_exists = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $email_exists;
}

function get_shopName(object $mysqli, string $shopname): bool {
    $query = "SELECT shopname FROM merchant WHERE shopname = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $shopname);

    $stmt->execute();

    $result = $stmt->get_result();

    $shop_exists = $result->num_rows > 0; // If rows are found, the username exists

    $stmt->close();

    return $shop_exists;
}

function set_user(object $mysqli, string $username, string $email, 
string $contactno, string $shopname, string $shopdescription) {
    $query = "INSERT INTO merchant (username, email, contactNo, shopName, merchDescription) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssss", $username, $email, $contactno, $shopname, $shopdescription);
    $stmt->execute();    
    $stmt->close();
}

function setDocument(object $mysqli, $merchantID, string $uniqueFilename, string $targetPath, string $docdescription) {
    $query = "INSERT INTO merch_documents (merchantID, document_name, document_path, doc_description) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("isss", $merchantID, $uniqueFilename, $targetPath,$docdescription);
    $stmt->execute();    
    $stmt->close();
}