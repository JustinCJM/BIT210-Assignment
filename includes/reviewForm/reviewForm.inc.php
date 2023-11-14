<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once '../dbh.inc.php';
    require_once 'reviewForm_model.inc.php';
    require_once 'reviewForm_contr.inc.php';
    require_once '../config_session.inc.php';

    $orderID = $_SESSION['review_order_id'];
    $productID = getOrderedProduct($mysqli, $orderID);

    $orderRating = $_POST['rating'];
    $reviewComment = $_POST['reviewComment'];
    $orderRating = (int)$orderRating;

    $errors = [];

    if(is_stars_empty($orderRating)) {
        $errors["empty_stars"] = "Please at least rate 1 star!";
    }
    if(is_comment_empty($reviewComment)) {
            $errors["empty_comment"] = "Please enter a comment!";
    }
    if (!empty($errors)) {
        $_SESSION["error_reviewOrder"] = $errors;
        header("Location: ../../reviewForm.php");
        die();
    }
    else {
        addReview($mysqli, $reviewComment, $orderRating, $orderID, $productID);
        header("Location: ../../reviewFormSuccess.php");
        die();
    } 
}
