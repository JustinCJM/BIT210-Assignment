<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'includes/config_session.inc.php';
require_once 'Kconfig.php';
require_once 'includes/dbh.inc.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderDate = date("d.m.Y");
    $orderStatus = "UNFULFILLED";
    $address = $_POST["address"] . ", " . $_POST["address2"] . ", " . $_POST["zip"] . ", " . $_POST["state"] . ", " . $_POST["country"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $total =$price * $quantity;
    $productID = $_POST["productID"];
    $paymentStatus = "success";
    $username = $_SESSION['user_username'];

    $merchantIDQuery = "SELECT merchantID FROM product WHERE productID = ?";
    $customerIDQuery = "SELECT customerID FROM customer WHERE username = ?";

    
    if ($stmt = $mysqli->prepare($merchantIDQuery)) {
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $stmt->bind_result($merchantID);
    
        $stmt->fetch();

        
        $stmt->close();
        }else {
            echo "Merchant ID not found";
        }

    if ($stmt = $mysqli->prepare($customerIDQuery)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($customerID);
    
        $stmt->fetch();

        
        $stmt->close();
        }else {
            echo "Customer ID not found";
        }


    if ($paymentStatus === "success") {

        $mysqli->begin_transaction();
    
        $insertsql = "INSERT INTO `orders` (`orderID`, `orderDate`, `orderStatus`, `billingAddress`, `totalAmount`, `quantity`, `customerID`, `merchantID`, `productID`) 
        VALUES  (NULL, current_timestamp(), '$orderStatus', '$address', '$total', '$quantity', '$customerID', '$merchantID', '$productID');";
       
        $mysqli->query($insertsql);

        $updatesql = "UPDATE product SET quantitySold = quantitySold + $quantity WHERE productID = $productID";

        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param('ii', $newQuantityValue, $productID);
        $updateStmt->execute();
        $mysqli->commit();

        if ($mysqli->query($insertsql) === TRUE) {
            echo $customerID;
            header("Location: Kpayment_success.php?<?php echo $customerID ?>");
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
