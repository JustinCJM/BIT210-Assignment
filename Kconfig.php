<?php 


require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

if (isset($_GET['productid'])) {
    $productID = $_GET['productid'];
    echo "PLEASE DELETE BEFORE PUBLISH ID NUMBER CHECK ".$productID;
    $sql = "SELECT productName, productPrice, category, prodLocation, prodDescription FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $productID); // "i" represents an integer, adjust it if necessary
    $stmt->execute();
    $stmt->bind_result($productName, $productPrice, $productCategory, $productLocation, $productDescription);
    
    $stmt->fetch();
    $stmt->close();
    $mysqli->close();
}


define('STRIPE_API_KEY','sk_test_51OAPd4LGJubRldED9fWbGDPI3AA0ni6cupG9Zh7MwxoCMUnsSAg8tXkIjiXAvvvlHIXccwB3BZ3ZtTBTGQq3obEA00hhTLEfrk');
define('STRIPE_PUBLISHABLE_KEY','pk_test_51OAPd4LGJubRldEDH9zsucB1K2IdemmjTSWu6F4uoJLnPmxRPBujgAVrIxNbK5msg0fh0SUiqQd5ZdbSYOWBNV3p00xrDJFTqY');
define('STRIPE_SUCCESS_URL','http://localhost/BIT210-Assignment/includes/productPurchase/success.php');
define('STRIPE_CANCEL_URL','http://localhost/BIT210-Assignment/includes/productPurchase/me.php');
?>
