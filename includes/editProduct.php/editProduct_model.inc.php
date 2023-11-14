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

function same_productName(object $mysqli, string $productName, int $productID): bool{
    $query = "SELECT productName FROM product WHERE productName = ? AND productID = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("si", $productName, $productID);

    $stmt->execute();

    $result = $stmt->get_result();

    $productName_same = $result->num_rows > 0;

    $stmt->close();

    return $productName_same;
}

function update_product_details(object $mysqli, int $productID, string $productName, string $productPrice, 
string $productCategory, string $productLocation, string $productDescription) {
    $query = "UPDATE product SET productName=?, productPrice=?, category=?, prodLocation=?, prodDescription=? WHERE productID=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssssi", $productName, $productPrice, $productCategory, $productLocation, $productDescription, $productID);
    $stmt->execute();    
    $stmt->close();
}

function setAdditionalImages(object $mysqli, $productID, string $uniqueFilename, string $targetPath) {
    $query = "INSERT INTO product_images (productID, image_name, image_path, display) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $display = 0;
    $stmt->bind_param("issi", $productID, $uniqueFilename, $targetPath, $display);
    $stmt->execute();    
    $stmt->close();
}