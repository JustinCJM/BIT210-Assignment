<?php

declare(strict_types=1);

function check_editProduct_errors() {
    if (isset($_SESSION["error_editProduct"])) {
        $errors = $_SESSION["error_editProduct"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';
        unset($_SESSION["error_editProduct"]);

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