<?php

declare(strict_types=1);

function check_addProduct_errors() {
    if (isset($_SESSION["error_addProduct"])) {
        $errors = $_SESSION["error_addProduct"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';
        unset($_SESSION["error_addProduct"]);

    } elseif (isset($_GET["addProduct"]) && $_GET["addProduct"] === "success") {
        echo '<script>';
        echo 'alert("Product Added Successfully!");';
        echo '</script>';
    }elseif (isset($_SESSION["upload_error"])) {
        $fileUploadError = $_SESSION["upload_error"];
        echo '<script>';
        echo 'alert("File Upload Error: ' . $fileUploadError . '");';
        echo '</script>';
        unset($_SESSION["upload_error"]);
}
}