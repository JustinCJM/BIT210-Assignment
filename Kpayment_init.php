<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'includes/config_session.inc.php';
require_once 'Kconfig.php';
require_once 'includes/dbh.inc.php';
require_once 'Kreceipt.php';


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
    $customerName = $_POST['fname']." ".$_POST['lname'];
    $invoiceNum = rand(4235,9999999);

    $merchantIDQuery = "SELECT merchantID FROM product WHERE productID = ?";
    $customerIDQuery = "SELECT customerID FROM customer WHERE username = ?";
    $productNameQuery = "SELECT productName FROM product WHERE productID = ?";

    if ($stmt = $mysqli->prepare($productNameQuery)) {
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $stmt->bind_result($productName);
    
        $stmt->fetch();

        
        $stmt->close();
        }else {
            echo "Product name not found";
        }

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
    
        $insertSql = "INSERT INTO `orders` (`orderID`, `orderDate`, `orderStatus`, `billingAddress`, `totalAmount`, `quantity`, `customerID`, `merchantID`, `productID`) 
        VALUES  (NULL, current_timestamp(), '$orderStatus', '$address', '$total', '$quantity', '$customerID', '$merchantID', '$productID');";
       
       if ($mysqli->query($insertSql) === false) {
        throw new Exception("Error inserting into 'orders' table: " . $mysqli->error);
    }

        $updateSql = "UPDATE product SET quantitySold = quantitySold + $quantity WHERE productID = $productID";
        if ($mysqli->query($updateSql) === false) {
            throw new Exception("Error updating 'product' table: " . $mysqli->error);
        }

        $mysqli->commit();
        $info=[
            "customer"=>$customerName,
            "address"=>$address,
            "invoice_no"=>"#".$invoiceNum,
            "invoice_date"=>$orderDate,
            "total_amt"=>$total,
          ];
          
          
          //invoice Products
          $products_info=[
            [
              "name"=>$productName,
              "price"=>$price,
              "qty"=>$quantity,
              "total"=>$total
            ],
          ];
            
            generateReceipt($info, $products_info);
            echo $customerID;
            header("Location: Kpayment_success.php?<?php echo $customerID ?>");
                    exit();
        // Close the database connection
        $mysqli->close();}
        else {
        
        echo "Payment failed. Please try again.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
