<?php
declare(strict_types = 1);

function get_productName(object $mysqli, string $productName): bool {
    $query = "SELECT productName FROM product WHERE productName = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $productName);

    $stmt->execute();

    $result = $stmt->get_result();

    $productName_exists = $result->num_rows > 0;

    $stmt->close();

    return $productName_exists;
}

function get_productPrice(object $mysqli, string $productPrice): bool {
     return $productPrice;
}

function set_product(object $mysqli, int $merchantID, string $productName, string $productPrice, 
string $productCategory, string $productLocation, string $productDescription) {
    $query = "INSERT INTO product (merchantID, productName, productPrice, category, prodLocation, prodDescription) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("isssss", $merchantID, $productName, $productPrice, $productCategory, $productLocation, $productDescription);
    $stmt->execute();    
    $stmt->close();
}

function setImage(object $mysqli, $productID, string $uniqueFilename, string $targetPath) {
    $query = "INSERT INTO product_images (productID, image_name, image_path) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iss", $productID, $uniqueFilename, $targetPath);
    $stmt->execute();    
    $stmt->close();
}
