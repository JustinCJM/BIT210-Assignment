<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'includes/config_session.inc.php';
require_once 'Kconfig.php';
require_once 'includes/dbh.inc.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderDate = date("d.m.Y");
    $orderStatus = "unfulfilled";
    $email = $_POST["email"];
    $address = $_POST["address"]." " .$_POST["address2"]." " .$_POST["state"]." ".$_POST["country"];
    
    $paymentStatus = "success";

    if ($paymentStatus === "success") {
    
        $sql = "INSERT INTO `orders` (`orderID`, `orderDate`, `orderStatus`, `billingAddress`, `totalAmount`, `customerID`, `merchantID`, `productID`) 
        VALUES  (NULL, current_timestamp(), '$orderStatus', '$address', '9999', '4', '30', '26');";

        if ($mysqli->query($sql) === TRUE) {
            
            header("Location: Kpayment_success.php");
            exit();
        } else {
            
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

       
        $mysqli->close();
    } else {
        
        echo "Payment failed. Please try again.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
