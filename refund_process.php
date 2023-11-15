<?php
require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

$refundID = $_GET['refundID'];
$status = $_GET['status'];

if ($status == 'accepted') {
    $query = "UPDATE refunds SET refundStatus = 'REFUNDED' WHERE refundID = " . $refundID;
    $mysqli->query($query);
    echo "<script>
        alert('Refund Request Approved.');
        window.location.href='viewMerchantRefunds.php';
    </script>";
}
else {
    $query = "UPDATE refunds SET refundStatus = 'REJECTED' WHERE refundID = " . $refundID;
    $mysqli->query($query);
    echo "<script>
        alert('Refund Request Rejected.');
        window.location.href='viewMerchantRefunds.php';
    </script>";
}

?>