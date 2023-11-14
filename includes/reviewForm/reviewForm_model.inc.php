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
