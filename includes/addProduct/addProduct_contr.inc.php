<?php
declare(strict_types = 1);

function is_input_empty(string $productName, string $productPrice, string $productCategory, string $productLocation, string $productDescription) {
    if(empty($productName) || empty($productPrice) || empty($productCategory) 
    || empty($productLocation) ||empty($productDescription)) {
        return true;
    } else {
        return false;
    }
}


function is_productName_taken(object $mysqli, string $productName) {
    if(get_productName($mysqli, $productName)) {
        return true;
    } else {
        return false;
    }
}

// function price_is_double(object $mysqli, string $productPrice){
//     return is_numeric($productPrice) && strpos($productPrice, '.') !== false;
// }

function create_product(object $mysqli, int $merchantID, string $productName, string $productPrice, string $productCategory, string $productLocation, string $productDescription) {
    set_product($mysqli, $merchantID, $productName, $productPrice, $productCategory, $productLocation, $productDescription);
}

function insertImage(object $mysqli, int $productID, string $uniqueFilename, string $targetPath) {
    setImage($mysqli, $productID, $uniqueFilename, $targetPath);
}

function insertAdditionalImages(object $mysqli, int $productID, string $uniqueFilename, string $targetPath) {
    setAdditionalImages($mysqli, $productID, $uniqueFilename, $targetPath);
}
