<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../dbh.inc.php';
    require_once 'editProduct_model.inc.php';
    require_once 'editProduct_contr.inc.php';
    require_once '../config_session.inc.php';
    
    $productID = $_POST['productid'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];
    $productLocation = $_POST['productLocation'];
    $productDescription = $_POST['productDescription'];

    $errors = [];

    if(is_input_empty($productName, $productPrice, $productCategory, $productLocation, $productDescription)) {
        $errors["empty_input"] = "Fill in all fields!";
    }
    if(is_productName_taken($mysqli, $productName)) {
        if(!is_productName_same($mysqli, $productName, $productID)){
            $errors["taken_productName"] = "Product name is already taken!";
        }
    }
    // if(!price_is_double($mysqli, $productPrice)) {
    //     $errors["price_notDouble"] = "Please eneter a valid price!";
    // }

    if (!empty($errors)) {
        $_SESSION["error_editProduct"] = $errors;
        header("Location: ../../editProduct.php");
        die();
    }

    update_product($mysqli, $productID, $productName, $productPrice, $productCategory, $productLocation, $productDescription);

    $uploadDirectory = '../../productUploads/';
    $targetDirectory = 'productUploads/';

    if (!empty($_FILES['image']['name'])) {
        $uniqueFilename = $productName . "_" . basename($_FILES["image"]["name"]);
        $uploadPath = $uploadDirectory . $uniqueFilename;
        $targetPath = $targetDirectory . $uniqueFilename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
            updateImage($mysqli, $productID, $uniqueFilename, $targetPath);
        } else {
            $errors["upload_error"] = "Failed to move the uploaded file.";
            $_SESSION["file_upload_error"] = $errors["upload_error"];
            echo "Error: " . $_FILES["image"]["error"];
            echo "Temp Name: " . $_FILES["image"]["tmp_name"];
            echo "Target Path: " . $targetPath;
        }
    }

    header("Location: ../../editProductSuccess.php");
    die();

    $mysqli = null;
    $stmt = null;

} else {
    header("Location: ../../editProduct.php");
    die();
}
