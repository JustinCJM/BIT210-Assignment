<?php
    require_once 'includes/config_session.inc.php';

    require_once 'includes/dbh.inc.php';

    $sql = "SELECT * FROM merchant";
    $result = $mysqli->query($sql);
    

    $id = $_GET['productid'];
    
    $product_sql = "DELETE FROM product WHERE productID = ". $id;
    $stmt = $mysqli->prepare($product_sql);
    $stmt->execute();    

    $images_sql = "DELETE FROM product_images WHERE productID = ". $id;
    $stmt = $mysqli->prepare($images_sql);
    $stmt->execute(); 

    echo"
    <script>
    alert('Product Deleted Successfully');
    document.location.href = 'merchantDashboard.php';
    </script>";
    
?>