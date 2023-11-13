<?php
require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];

    // Update order status to COMPLETED
    $updateQuery = "UPDATE orders SET orderStatus = 'COMPLETED' WHERE orderID = ?";
    $stmt = $mysqli->prepare($updateQuery);
    
    if ($stmt) {
        $stmt->bind_param("i", $orderID);
        $stmt->execute();
        $stmt->close();
    }

    $mysqli->close();

    echo "Order status updated successfully";
} else {
    echo "Invalid request";
}
?>