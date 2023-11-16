<?php
require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

$refundID = $_GET['refundID'];
$orderID = $_GET['orderID'];
$status = $_GET['status'];

if ($status == 'accepted') {
    $query = "UPDATE refunds SET refundStatus = 'REFUNDED' WHERE refundID = " . $refundID;
    $query2 = "UPDATE orders SET orderStatus = 'REFUNDED' WHERE orderID = " . $orderID;
    $mysqli->query($query);
    $mysqli->query($query2);
    echo "<script>
        alert('Refund Request Approved.');
        window.location.href='viewMerchantRefunds.php';
    </script>";
}
else {
    $query = "UPDATE refunds SET refundStatus = 'REJECTED' WHERE refundID = " . $refundID;
    $query2 = "UPDATE orders SET orderStatus = 'COMPLETED' WHERE orderID = " . $orderID;
    $mysqli->query($query);
    $mysqli->query($query2);
    echo "<script>
        alert('Refund Request Rejected.');
        window.location.href='viewMerchantRefunds.php';
    </script>";
}

?>