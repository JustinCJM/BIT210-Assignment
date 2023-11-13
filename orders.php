<?php
require_once 'includes/config_session.inc.php';
//require_once 'includes/editProduct/editProduct_view.inc.php';

include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="icon" type="image/png" href="assets/logo.png" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
</head>
<body>
    <?php
    $userType = $_SESSION["user_type"] ?? null;  
    if ($userType === 'merchant') {
        include 'includes/headers/header_merchant.inc.php';
    } elseif ($userType === 'customer') {
        include 'includes/headers/header_customer.inc.php';
    } elseif ($userType === 'tourism_ministry_officer') {
        include 'includes/headers/header_officer.inc.php';
    } else {
        include 'includes/headers/defaultheader.inc.php';
    }
    $username = $_SESSION['user_username'];

$mysqli = new mysqli("localhost", "root", "", "travurr_database");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// Use prepared statement to prevent SQL injection
$sql = "SELECT customerID FROM customer WHERE username = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username); // Assuming username is a string, change the "s" if needed

    if ($stmt->execute()) {
        $stmt->bind_result($customerID); // Bind the result to a variable
        $stmt->fetch();

        // Now $customerID contains the value you retrieved
        echo "Customer ID: " . $customerID;
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $mysqli->error;
}

$sql = "SELECT orderID FROM orders WHERE customerID = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $customerID); // Assuming customerID is an integer, change the "i" if needed

    if ($stmt->execute()) {
        $stmt->bind_result($orderID); // Bind the result to a variable

        // Fetch the result (assuming only one result)
        if ($stmt->fetch()) {
            // Now $orderID contains the orderID associated with the customerID
            echo "Order ID: " . $orderID . "<br>";
        } else {
            echo "No order found for the customer.";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $mysqli->error;
}

$mysqli->close();

echo '<a href="reviewForm.php?orderid='.$orderID.'" class="btn btn-primary btn-lg">Edit</a>';
?>


</body>
</html>

<?php
?>