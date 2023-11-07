<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Travel Website</title>
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
    ?>

    <div class="vh-100 page-body">
        <div class="container py-5" style="height: 90%">
            <div class="card" style="border-radius: 1rem">
                <div class='row'></div>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "travurr_database";
                
                $conn = new mysqli($servername, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $username = $_SESSION['user_username'];
                $query = "SELECT merchantID FROM merchant WHERE username = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->bind_result($merchantID);
                
                // Check if the first query is successful
                if (!$stmt->fetch()) {
                    die("Failed to fetch merchantID: " . $stmt->error);
                }
                
                // Close the first prepared statement
                $stmt->close();
                
                $sql = "SELECT * FROM product WHERE merchantID = ?"; // Use a parameter marker
                $stmt2 = $conn->prepare($sql);
                $stmt2->bind_param("i", $merchantID);
                $stmt2->execute();
                $result = $stmt2->get_result();
                
                // Check if the second query is successful
                if (!$result) {
                    die("Query failed: " . $stmt2->error);
                }

                if (mysqli_num_rows($result) == 0) {
                    echo "No products found for this merchant.";
                } else {
                    
                while ($row = $result->fetch_assoc()) {
                    $productName = $row['productName'];
                    $productDescription = $row['prodDescription'];
                    $productPrice = $row['productPrice'];
                    echo("<div class='box'>
                        <div class='content'>
                            <h3><i class='fas fa-archive'>&nbsp;$productName</i></h3>
                            <p>$productDescription</p>
                            <div class='price'>$productPrice</div>
                            
                        </div>
                    </div>");
                }
            }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
