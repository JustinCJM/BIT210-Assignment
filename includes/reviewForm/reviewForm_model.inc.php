<?php

declare(strict_types=1);

function getOrderDetails(object $mysqli, int $orderID)
{

    $query = "SELECT * FROM orders WHERE orderID = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $orderID);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();
            $stmt->close();

            return $rows;
        } else {
            echo "Query execution failed: " . $stmt->error;
            return null;
        }
    } else {
        echo "Query preparation failed: " . $mysqli->error;
        return null;
    }
}

function getProductDetails(object $mysqli, int $productID){

    $query = "SELECT * FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $productID);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();
            $stmt->close();

            return $rows;
        } else {
            echo "Query execution failed: " . $stmt->error;
            return null;
        }
    } else {
        echo "Query preparation failed: " . $mysqli->error;
        return null;
    }
}

function getOrderedProduct(object $mysqli, int $orderID)
{
    $query = "SELECT productID FROM orders WHERE orderID = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $orderID);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $productID = $result->fetch_assoc()['productID']; // Fetch the productID directly
            $stmt->close();

            return $productID;
        } else {
            echo "Query execution failed: " . $stmt->error;
            return null;
        }
    } else {
        echo "Query preparation failed: " . $mysqli->error;
        return null;
    }
}


function setReview(object $mysqli, string $comments, int $rating, int $orderID, int $productID)
{
    $updateOrderQuery = "UPDATE orders SET orderStatus = 'REVIEWED' WHERE orderID = ?";
    $updateOrderStmt = $mysqli->prepare($updateOrderQuery);

    if ($updateOrderStmt) {
        $updateOrderStmt->bind_param("i", $orderID);

        if (!$updateOrderStmt->execute()) {
            echo "Update orderStatus query execution failed: " . $updateOrderStmt->error;
            $updateOrderStmt->close();
            return false;
        }

        $updateOrderStmt->close();
    } else {
        echo "Update orderStatus query preparation failed: " . $mysqli->error;
        return false;
    }

    $insertReviewQuery = "INSERT INTO reviews (comments, rating, orderID, productID) VALUES (?, ?, ?, ?)";
    $insertReviewStmt = $mysqli->prepare($insertReviewQuery);

    if ($insertReviewStmt) {
        $insertReviewStmt->bind_param("siii", $comments, $rating, $orderID, $productID);

        if ($insertReviewStmt->execute()) {
            $insertReviewStmt->close();
            return true;
        } else {
            echo "Insert review query execution failed: " . $insertReviewStmt->error;
            $insertReviewStmt->close();
            return false;
        }
    } else {
        echo "Insert review query preparation failed: " . $mysqli->error;
        return false;
    }
}

function updateRating(object $mysqli, int $productID){
    $sumOfRatingQuery = "SELECT SUM(rating) AS sum_of_rating FROM reviews WHERE productID = ?";
    $updateRatingQuery = "UPDATE product SET totalRating = ? WHERE productID = ?";
    
    // Prepare the SELECT query
    $sumOfRatingStmt = $mysqli->prepare($sumOfRatingQuery);

    if ($sumOfRatingStmt) {
        $sumOfRatingStmt->bind_param("i", $productID);

        if (!$sumOfRatingStmt->execute()) {
            echo "SELECT query execution failed: " . $sumOfRatingStmt->error;
            $sumOfRatingStmt->close();
            return false;
        }

        // Bind the result variable
        $sumOfRatingStmt->bind_result($sumOfRating);

        // Fetch the result
        $sumOfRatingStmt->fetch();

        // Close the SELECT statement
        $sumOfRatingStmt->close();

        // Display the sum of ratings (optional)
        echo "Sum of ratings: " . $sumOfRating;

        // Prepare the UPDATE query
        $updateRatingStmt = $mysqli->prepare($updateRatingQuery);

        if ($updateRatingStmt) {
            $updateRatingStmt->bind_param("ii", $sumOfRating, $productID);

            if (!$updateRatingStmt->execute()) {
                echo "UPDATE query execution failed: " . $updateRatingStmt->error;
                $updateRatingStmt->close();
                return false;
            }

            // Close the UPDATE statement
            $updateRatingStmt->close();

            return true;
        } else {
            echo "UPDATE query preparation failed: " . $mysqli->error;
            return false;
        }
    } else {
        echo "SELECT query preparation failed: " . $mysqli->error;
        return false;
    }
}

function updateAvgRating(object $mysqli, int $productID) {
    // Get totalRating from products
    $totalRatingQuery = "SELECT totalRating FROM product WHERE productID = ?";
    $totalRatingStmt = $mysqli->prepare($totalRatingQuery);

    if ($totalRatingStmt) {
        $totalRatingStmt->bind_param("i", $productID);

        if (!$totalRatingStmt->execute()) {
            echo "SELECT totalRating query execution failed: " . $totalRatingStmt->error;
            $totalRatingStmt->close();
            return false;
        }

        $totalRatingStmt->bind_result($totalRating);
        $totalRatingStmt->fetch();

        // Close the SELECT statement
        $totalRatingStmt->close();
    } else {
        echo "SELECT totalRating query preparation failed: " . $mysqli->error;
        return false;
    }

    // Get the number of reviews
    $reviewCountQuery = "SELECT COUNT(*) AS review_count FROM reviews WHERE productID = ?";
    $reviewCountStmt = $mysqli->prepare($reviewCountQuery);

    if ($reviewCountStmt) {
        $reviewCountStmt->bind_param("i", $productID);

        if (!$reviewCountStmt->execute()) {
            echo "SELECT review_count query execution failed: " . $reviewCountStmt->error;
            $reviewCountStmt->close();
            return false;
        }

        $reviewCountStmt->bind_result($reviewCount);
        $reviewCountStmt->fetch();

        // Close the SELECT statement
        $reviewCountStmt->close();
    } else {
        echo "SELECT review_count query preparation failed: " . $mysqli->error;
        return false;
    }

    // Calculate average rating and update products table
    if ($reviewCount > 0) {
        $avgRating = $totalRating / $reviewCount;

        // Update avgRating in products table
        $updateAvgRatingQuery = "UPDATE product SET avgRating = ? WHERE productID = ?";
        $updateAvgRatingStmt = $mysqli->prepare($updateAvgRatingQuery);

        if ($updateAvgRatingStmt) {
            $updateAvgRatingStmt->bind_param("di", $avgRating, $productID);

            if (!$updateAvgRatingStmt->execute()) {
                echo "UPDATE avgRating query execution failed: " . $updateAvgRatingStmt->error;
                $updateAvgRatingStmt->close();
                return false;
            }

            // Close the UPDATE statement
            $updateAvgRatingStmt->close();

            return true;
        } else {
            echo "UPDATE avgRating query preparation failed: " . $mysqli->error;
            return false;
        }
    } else {
        // Handle the case where there are no reviews
        echo "No reviews available for productID: $productID";
        return false;
    }
}



