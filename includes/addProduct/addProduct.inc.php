<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../dbh.inc.php';
    require_once 'addProduct_model.inc.php';
    require_once 'addProduct_contr.inc.php';
    require_once '../config_session.inc.php';
    
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productCategory = $_POST["productCategory"];
    $productLocation = $_POST["productLocation"];
    $productDescription = $_POST["productDescription"];

    $errors = [];

    $username = $_SESSION['user_username'];

    $query = "SELECT merchantID FROM merchant WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $stmt->bind_result($merchantID);
            $merchantID = (int)$merchantID;
            $stmt->fetch();
            $stmt->close();
        } else {
            echo "Query execution failed: " . $stmt->error;
        }
    } else {
        echo "Statement preparation failed: " . $mysqli->error;
    }

    if(is_input_empty($productName, $productPrice, $productCategory, $productLocation, $productDescription)) {
        $errors["empty_input"] = "Fill in all fields!";
    }
    if(is_productName_taken($mysqli, $productName)) {
        $errors["taken_productName"] = "Product name is already taken!";
    }
    if(!price_is_double($mysqli, $productPrice)) {
         $errors["price_notDouble"] = "Please enter a valid price!";
    }

    if(!$_FILES["image"]['tmp_name']){
        $errors["no_displayImage"] = "Please upload a display image!";
    }

    if (!empty($errors)) {
        $_SESSION["error_addProduct"] = $errors;
        header("Location: ../../addProducts.php");
        die();
    }

    create_product($mysqli, $merchantID, $productName, $productPrice, $productCategory, $productLocation, $productDescription);


    $productID = $mysqli->insert_id;

    $productID = (int)$productID;

    $uploadDirectory = '../../productUploads/';
    $targetDirectory = 'productUploads/';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uniqueFilename = $productName . "_" . basename($_FILES["image"]["name"]);
    $uploadPath = $uploadDirectory . $uniqueFilename;
    $targetPath = $targetDirectory . $uniqueFilename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
        insertImage($mysqli, $productID, $uniqueFilename, $targetPath);
    } else {
        $errors["upload_error"] = "Failed to move the uploaded file.";
        $_SESSION["file_upload_error"] = $errors["upload_error"];
        echo "Error: " . $_FILES["image"]["error"];
        echo "Temp Name: " . $_FILES["image"]["tmp_name"];
        echo "Target Path: " . $targetPath;
    }

    $index = 0;
    foreach ($_FILES["images"]["name"] as $x) {
        $uniqueFilename = $productName . "_" . basename($_FILES["images"]["name"][$index]);
        $uploadPath = $uploadDirectory . $uniqueFilename;
        $targetPath = $targetDirectory . $uniqueFilename;
    
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$index], $uploadPath)) {
            insertAdditionalImages($mysqli, $productID, $uniqueFilename, $targetPath);
        } else {
            $errors["upload_error"] = "Failed to move the uploaded file.";
            $_SESSION["file_upload_error"] = $errors["upload_error"];
            echo "Error: " . $_FILES["images"]["error"][$index];
            echo "Temp Name: " . $_FILES["images"]["tmp_name"][$index];
            echo "Target Path: " . $targetPath;
        }
        $index++;
    }

    header("Location: ../../addProductSuccess.php");
    die();

    $mysqli = null;
    $stmt = null;

} else {
    header("Location: ../../addProducts.php");
    die();
}
