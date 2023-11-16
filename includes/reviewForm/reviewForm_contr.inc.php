<?php

declare(strict_types = 1);

function is_stars_empty(int $orderRating) {
    return $orderRating < 1;
}

function is_comment_empty(string $reviewComment) {
    return empty($reviewComment);
}
function addReview(object $mysqli, string $comments, int $rating, int $orderID, int $productID){
    setReview($mysqli, $comments, $rating, $orderID, $productID);
    updateRating($mysqli, $productID);
    updateAvgRating($mysqli, $productID);
}