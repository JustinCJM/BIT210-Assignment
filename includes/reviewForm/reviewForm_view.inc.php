<?php

declare(strict_types=1);

require_once 'reviewForm_model.inc.php';

function displayOrderDetails($mysqli, $orderID) {
    $orderDetails = getOrderDetails($mysqli, $orderID);

    if ($orderDetails) {
        // Fetch product details
        $productID = $orderDetails['productID'];
        $productDetails = getProductDetails($mysqli, $productID);

        if ($productDetails) {
            $imagePath = getImagePath($mysqli, $productID);
            $orderDate = new DateTime($orderDetails['orderDate']);
            $formattedOrderDate = $orderDate->format('jS F Y');
            echo 
            '<div class = "row px-5 py-5">
            <div class = "col">
                    <img src="'. $imagePath .'" class="card-img-top" style="max-width: 25rem; height: 25rem;" alt="Product Image">
                    </div>
                    <div class = "col">
                        <h5 class="card-title">' . $formattedOrderDate . '</h5>
                        <p class="card-text">Price: RM' . number_format(floatval($orderDetails['totalAmount']), 2) . '</p>
                        <p class="card-text">Shipped to: ' . $orderDetails['billingAddress'] . '</p>
                        <p class="card-text">Product Name: ' . $productDetails['productName'] . '</p>
                        <p class="card-text">Location: ' . $productDetails['prodLocation'] . '</p>
                        <p class="card-text">Category: ' . $productDetails['category'] . '</p>
                        <p class="card-text">Description: ' . $productDetails['prodDescription'] . '</p>
            </div>
            </div>';
        } else {
            echo 'Product details not found.';
        }
    } else {
        echo 'No results found.';
    }
}



function getImagePath($mysqli, $productID) {
    $imagePath = '';

    $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID";
    $imageResult = mysqli_query($mysqli, $imageQuery);

    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
        $imageData = mysqli_fetch_assoc($imageResult);
        $imagePath = $imageData['image_path'];
    }

    return $imagePath;
}

function check_reviewOrder_errors() {
    if (isset($_SESSION["error_reviewOrder"])) {
        $errors = $_SESSION["error_reviewOrder"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';
        unset($_SESSION["error_reviewOrder"]);

    } elseif (isset($_GET["editProduct"]) && $_GET["editProduct"] === "success") {
        echo '<script>';
        echo 'alert("Product Edited Successfully!");';
        echo '</script>';
    }elseif (isset($_SESSION["upload_error"])) {
        $fileUploadError = $_SESSION["upload_error"];
        echo '<script>';
        echo 'alert("File Upload Error: ' . $fileUploadError . '");';
        echo '</script>';
        unset($_SESSION["upload_error"]);
    }
}