<?php

declare(strict_types=1);

function getProducts(object $mysqli)
{
    $username = $_SESSION['user_username'];

    $query = "SELECT merchantID FROM merchant WHERE username = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $stmt->bind_result($resultMerchantID);
            $stmt->fetch();
            $stmt->close();

            $merchantID = (int)$resultMerchantID;

            $query = "SELECT * FROM product WHERE merchantID = ?";

            // Prepare and execute the second query
            $stmt = $mysqli->prepare($query);

            if ($stmt) {
                $stmt->bind_param('i', $merchantID);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    return $result;

                    if ($result !== false) {
                        displayProduct($result);
                    } else {
                        echo "Error in fetching results: " . $stmt->error;
                    }
                } else {
                    echo "Query execution failed: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Second query preparation failed: " . $mysqli->error;
            }
        } else {
            echo "First query execution failed: " . $stmt->error;
        }
    } else {
        echo "First query preparation failed: " . $mysqli->error;
    }
}
