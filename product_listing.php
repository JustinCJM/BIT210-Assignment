<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
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

    <body>
        <?php
            $id = $_GET['productid'];
            $query = "SELECT * FROM product WHERE productID = $id ";

            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = mysqli_fetch_assoc($stmt->get_result());
            // var_dump($result);
            
            $name = $result['productName'];
            $quantity = $result['maxQuantity'];
            $price = number_format($result['productPrice'], 2);
            $description = $result['prodDescription'];
        ?>


        <div class="vh-100 page-body">
            <div class="container py-5" style="height: 90%">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card" style="border-radius: 1rem">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-4 d-md-flex d-md-block">
                                <img src="product_image.jpg" class="card-img-top" alt="Product Image">
                            </div>
                        
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <div class="row g-0">
                                        <h1 class="mb-2 pb-2" style="letter-spacing: 1px">
                                            <?php echo $name; ?>
                                        </h1>

                                        <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                                            RM <?php echo $price; ?>
                                        </h2>
                                        
                                        <div class="fw-normal mb-3 pb-3 w-25" style="letter-spacing: 1px">
                                            <label for="quantity">Quantity: </label>
                                            <h3>
                                                <input type="number" id="quantity" class="form-control form-icon-trailing" value="1" min="1" max="<?php echo $quantity; ?>"/>
                                            </h3>
                                        </div>
                                        
                                        <hr/>
                                        
                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                                            <?php echo $description; ?>
                                        </h3>

                                        <div class="pt-1 mb-4">
                                            <button
                                                class="btn btn-primary btn-lg btn-block"
                                                style="background-color: #7c4dff;"
                                                type="submit"
                                            >
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

