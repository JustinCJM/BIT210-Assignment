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

function is_productName_same(object $mysqli, string $productName, int $productID){
    if (same_productName($mysqli, $productName, $productID)){
        return true;
    }else{
        return false;
    }
}
 function price_is_double(object $mysqli, string $productPrice){
     return is_numeric($productPrice) && strpos($productPrice, '.') !== false;
 }

function update_product(object $mysqli, int $merchantID, string $productName, string $productPrice, string $productCategory, string $productLocation, string $productDescription) {
    update_product_details($mysqli, $merchantID, $productName, $productPrice, $productCategory, $productLocation, $productDescription);
}

function insertAdditionalImages(object $mysqli, int $productID, string $uniqueFilename, string $targetPath) {
    setAdditionalImages($mysqli, $productID, $uniqueFilename, $targetPath);
}
