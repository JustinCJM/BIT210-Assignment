<?php
require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

$custName = $_SESSION['user_username'];

$query = "SELECT r.*, o.*, p.*, pi.image_path, m.shopName
            FROM refunds r
            JOIN orders o ON r.orderID = o.orderID
            JOIN product p ON o.productID = p.productID
            JOIN product_images pi ON p.productID = pi.productID
            JOIN merchant m ON p.merchantID = m.merchantID
            WHERE o.customerID = (
            SELECT customerID FROM customer WHERE username = ?
            ) AND pi.display =1
            ORDER BY r.refundDate DESC";

$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $custName);
    $stmt->execute();
    $result = $stmt->get_result();
}
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
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous"
        />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <link rel="stylesheet" href="style.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
        
</head>

    <?php
    include 'includes/headers/header_customer.inc.php';
    ?>

    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Side Menu -->
                <nav class="col-md-3 d-none d-md-block side-menu" style="text-align:center">
                    <h5 class="text-center"><?php echo $_SESSION["user_username"] ?>'s Dashboard</h5>
                    <hr class="my-4">
                    <a href="customer_dashboard.php">Customer Purchases</a>
                    <a href="#" style="font-weight: 600;">Refunds</a>
                    <a href="#">Account Details</a>
                    <!-- Add more links as needed -->
                </nav>

                <div class="col-md-6 purchase-container p-4">
                <div class="h3 pb-4 pt-3">Refund Requests</div>
                        <?php
                        if($result) {
                            if(mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='order-listing bg-light mb-4'>
                                            <div class='p-4'>
                                                <div class='d-flex justify-content-between align-items-center p-2'>
                                                    <div class='d-flex align-items-center'>
                                                        <img src='assets/stall.png' style='width: 1.5rem;' alt='Packages'/>
                                                        <h4 class='p-2'>{$row['shopName']}</h4>
                                                    </div>
                                                    <div>
                                                        <h5 class='ml-auto'>Refund ID: {$row['refundID']}</h5>
                                                    </div>
                                                </div>
                                                <hr class='my-4'>
                                                <div class='d-flex align-items-center justify-content-between p-2'>
                                                    <div class='d-flex align-items-center'>
                                                        <img src='{$row['image_path']}' alt='Product Image' style='width: 8rem; height: 6rem; border: 1px solid grey'>
                                                        <p class='p-4 fs-5'>{$row['productName']}</p>
                                                    </div>
                                                    <p>Quantity: {$row['quantity']}</p>
                                                </div>
                                                <div class='d-flex m-2'>
                                                </div>
                                                <hr class='my-4'>
                                                <div class='d-flex justify-content-between align-items-center p-2'>
                                                    <div class='fs-5'>
                                                        Refund Reason: {$row['refundDescription']}
                                                    </div>
                                                </div>
                                                <hr class='my-4'>
                                                <div class='d-flex justify-content-between align-items-center p-2'>
                                                    <div class='fs-5'>
                                                        Refund Date: {$row['refundDate']}
                                                    </div>
                                                    <div class='ml-auto'>
                                                        <h3>Order Total: RM{$row['totalAmount']}</h3>
                                                    </div>
                                                </div>
                                                <div class='d-flex justify-content-between align-items-center p-2'>
                                                    <div></div>
                                                    <div class='ml-auto'>";
                                            if ($row['refundStatus'] == "AWAITING REFUND") {
                                                echo "<div class='fs-5'>Awaiting response from the seller</div>";
                                            } elseif ($row['refundStatus'] == "REFUNDED") {
                                                echo "<div class='fs-5'>This order has been refunded</div>";
                                            } else {
                                                echo "<div class='fs-5'>Your refund request has been rejected</div>";
                                            };
                                    echo "  </div>
                                        </div>
                                    </div>";
                                }

                            } else {
                                echo "No Refunds Requests Found.";
                            }
                        } 
                        
                        ?>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"
        >
        </script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="script.js"></script>
    </body>
</html>