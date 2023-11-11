<?php 


require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

if (isset($_GET['productid'])) {
    $productID = $_GET['productid'];
    echo "PLEASE DELETE BEFORE PUBLISH ID NUMBER CHECK ".$productID;
    $sql = "SELECT image_path FROM product_images WHERE productID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $productID); // "i" represents an integer, adjust it if necessary
    $stmt->execute();
    $stmt->bind_result($productImage);
    
    $stmt->fetch();
    $stmt->close();
}

if (isset($_GET['productid'])) {
    $productID = $_GET['productid'];
    $sql = "SELECT productName, productPrice, category, prodLocation, prodDescription FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $productID); // "i" represents an integer, adjust it if necessary
    $stmt->execute();
    $stmt->bind_result($productName, $productPrice, $productCategory, $productLocation, $productDescription);
    
    $stmt->fetch();
    $stmt->close();
    $mysqli->close();
}

$username = $_SESSION['user_username'];

?>
