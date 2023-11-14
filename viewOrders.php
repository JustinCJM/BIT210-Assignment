<?php
require_once 'includes/config_session.inc.php';
include 'includes/dbh.inc.php';

$merchName = $_SESSION['user_username'];

$query = "SELECT o.*, p.*,pi.image_path, c.username
            FROM orders o
            JOIN product p ON o.productID = p.productID
            JOIN product_images pi ON o.productID = pi.productID
            JOIN customer c ON o.customerID = c.customerID
            WHERE p.merchantID = (
                SELECT merchantID FROM merchant WHERE username = ?
            )";

$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $merchName);
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
    include 'includes/headers/header_merchant.inc.php';
    ?>

    <body>
        <div class="container-fluid pb-5">
            <div class="row">
                <nav class="col-md-2 d-md-block side-menu p-5" style="text-align:center">
                    <h5 class="text-center"><?php echo $_SESSION["user_username"] ?>'s Dashboard</h5>
                    <hr class="my-3">
                    <a href="merchantDashboard.php">My Products</a>
                    <a href="#" style="font-weight: 600;">My Orders</a>
                    <a href="viewMerchantRefunds.php">Refund Requests</a>
                        <!-- Add more links as needed -->
                </nav>

                <div class="col-md-6 offset-md-1 purchase-container pt-4">
                    <div class='d-flex align-items-center justify-content-between h3 p-4'>
                    <button id="unfinished-orders-tab" class="orders-tab btn fs-5 active">Unfinished Orders</button>
                    <button id="completed-orders-tab" class="orders-tab fs-5 btn">Completed Orders</button>
                    <button id="reviewed-orders-tab" class="orders-tab fs-5 btn">Reviewed Orders</button>
                    <button id="refunded-orders-tab" class="orders-tab fs-5 btn">Refunded Orders</button>
                    </div>
                    <?php
                    $allOrders = [];
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $allOrders[] = $row;
                        }

                        $unfinishedOrders = array_filter($allOrders, function ($order) {
                            return $order['orderStatus'] == 'UNFULFILLED';
                        });

                        $completedOrders = array_filter($allOrders, function ($order) {
                            return $order['orderStatus'] == 'COMPLETED';
                        });

                        $reviewedOrders = array_filter($allOrders, function ($order) {
                            return $order['orderStatus'] == 'REVIEWED';
                        });

                        $refundedOrders = array_filter($allOrders, function ($order) {
                            return $order['orderStatus'] == 'REFUNDED';
                        });

                        function displayOrders($orders) {
                            foreach ($orders as $row) {
                                echo "<div class='order-listing bg-light mb-4'>
                                    <div class='p-4'>
                                        <div class='d-flex justify-content-between align-items-center p-2'>
                                            <div class='d-flex align-items-center'>
                                                <img src='assets/man-with-shopping.png' style='width: 1.5rem;' alt='Packages'/>
                                                <h4 class='p-2'>Customer: {$row['username']}</h4>
                                            </div>
                                            <div>
                                                <h5 class='ml-auto'>Order ID: {$row['orderID']}</h5>
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
                                                Order Date & Time: {$row['orderDate']}
                                            </div>
                                            <div class='ml-auto'>
                                                <h3>Order Total: RM{$row['totalAmount']}</h3>
                                            </div>
                                        </div>
                                        <div class='d-flex justify-content-between align-items-center p-2'>
                                            <div class='fs-5'>
                                                Order Status: {$row['orderStatus']}
                                            </div>
                                            <div class='ml-auto'>";
                                            if ($row['orderStatus'] == "REVIEWED") {
                                                echo "<button type='button' class='btn me-2' style='background-color:#7c4dff; color:white;'>View Review</button>
                                                        </div>";
                                            } elseif  ($row['orderStatus'] == "COMPLETED"){
                                                echo "<button type='button' class='btn me-2' style='background-color:#7c4dff; color:white;'disabled>View Review</button>
                                                        </div>";
                                            } elseif ($row['orderStatus'] == "REFUNDED") {
                                                echo "<div class='fs-5'>This order has been refunded</div>";
                                            } else {
                                                echo "<button type='button' class='btn me-2' style='background-color:#7c4dff; color:white;'
                                                        onclick='fulfillOrderConfirmation({$row['orderID']})'>Fulfill Order</button>
                                                        <button type='button' class='btn btn-light'>Cancel Order</button>
                                                        </div>";
                                            };
                                echo "  </div>
                                    </div>
                                </div>";
                            }
                        }
                    } else {
                        echo "No orders found";
                    }
                        
                        ?>
                        <div id="unfinished-orders" class="orders-tab-content">
                            <?php displayOrders($unfinishedOrders); ?>
                        </div>
                        <div id="completed-orders" class="orders-tab-content" style="display: none;">
                            <?php displayOrders($completedOrders); ?>
                        </div>
                        <div id="reviewed-orders" class="orders-tab-content" style="display: none;">
                            <?php displayOrders($reviewedOrders); ?>
                        </div>
                        <div id="refunded-orders" class="orders-tab-content" style="display: none;">
                            <?php displayOrders($refundedOrders); ?>
                        </div>
                </div>
            </div>
        </div>
        <script>
        document.getElementById('unfinished-orders-tab').addEventListener('click', function () {
            showOrdersTab('unfinished-orders');
        });

        document.getElementById('completed-orders-tab').addEventListener('click', function () {
            showOrdersTab('completed-orders');
        });

        document.getElementById('reviewed-orders-tab').addEventListener('click', function () {
            showOrdersTab('reviewed-orders');
        });

        document.getElementById('refunded-orders-tab').addEventListener('click', function () {
            showOrdersTab('refunded-orders');
        });

        function showOrdersTab(tabId) {
        // Hide all tabs
        var tabs = document.getElementsByClassName('orders-tab-content');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].style.display = 'none';
        }

        // Show the selected tab
        document.getElementById(tabId).style.display = 'block';

        // Update the active tab style
        var activeTabs = document.getElementsByClassName('orders-tab');
        for (var i = 0; i < activeTabs.length; i++) {
            activeTabs[i].classList.remove('active');
        }
        document.getElementById(tabId + '-tab').classList.add('active');
        }

        function fulfillOrderConfirmation(orderID) {
            if (confirm("Are you sure you want to fulfill this order?")) {
                fulfillOrder(orderID);
            }
        }

        function fulfillOrder(orderID) {
            // Send an AJAX request to update order status
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/updateOrders.inc.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send('orderID=' + orderID);
        }
        </script>
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