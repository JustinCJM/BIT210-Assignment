<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Product Catalog</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body class="vh-190 page-body">
    <?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/dbh.inc.php';
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

    <section class="section-products">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h2 id='header'>Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                require_once 'includes/config_session.inc.php';
                require_once 'includes/dbh.inc.php';

                
                $sql = "SELECT product.productID, product.productName, product.productPrice, product_images.image_path 
                        FROM product 
                        LEFT JOIN product_images ON product.productID = product_images.productID";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="single-product">
                                <div class="part-1">
                                    <ul>
                                        <li><a href="Kproduct.php?productid=<?php echo $row['productID']; ?>" target="_blank">
                                            <i class="fab fa-apple-pay"></i>
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                    <img src="<?php echo $row['image_path']; ?>" alt="Product Image" width="200" height="200">
                                    <h3 class="product-title"><?php echo $row['productName']; ?></h3>
                                    <h4 class="product-new-price">$<?php echo $row['productPrice']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                $mysqli->close();
                ?>
            </div>
        </div>
    </section>

</body>
</html>
