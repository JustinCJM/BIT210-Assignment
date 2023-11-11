<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
    <style>
        #prodImg {
            display: block;
            max-height:350px;
            width: auto;
            height: auto;
        }    
    </style>
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
            $imageQuery = "SELECT image_path FROM product_images WHERE productID = $id";

            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = mysqli_fetch_assoc($stmt->get_result());
            // var_dump($result);
            
            $name = $result['productName'];
            $quantity = $result['maxQuantity'];
            $price = number_format($result['productPrice'], 2);
            $description = $result['prodDescription'];

            $imageResult = mysqli_query($mysqli, $imageQuery);
        
            $imagePath = '';
            if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                $imageData = mysqli_fetch_assoc($imageResult);
                $imagePath = $imageData['image_path'];
            }
        ?>


        <div class="page-body">
            <div class="container py-5" style="height: 90%">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card" style="border-radius: 1rem">
                        <div class="row g-0">
                            <div class="card-body p-4 px-5 pb-5">
                                <h1 class="mb-2 p-3" style="letter-spacing: 1px;">
                                    <b><?php echo $name; ?></b>
                                </h1>
                            
                                <div class="d-md-flex d-md-block p-2 align-items-center">
                                    <img id="prodImg" src="<?php echo $imagePath; ?>" class="card-img-top center" alt="Product Image">
                                </div>
                            </div>
                            
                            <hr/>
                        
                            <div class="d-flex align-items-center">
                                <div class="card-body p-2 p-lg-5 text-black">
                                    <div class="row g-0">
                                        <div class="col-md-6 col-lg-9 p-1 d-md-flex d-md-block" style="margin-right: 5px;">
                                            <h3 class="fw-normal pb-3" style="letter-spacing: 1px; margin-right: 100px;">
                                                <?php echo $description; ?>
                                            </h3>
                                        </div>

                                        <div class="row col-md-6 col-lg-3 d-flex align-items-center">
                                            <h2 class="fw-normal mb-3 p-1" style="letter-spacing: 1px">
                                                RM <?php echo $price; ?>
                                            </h2>

                                            <label for="quantity" style="padding: 5px; font-size: 120%;">Quantity: </label>
                                            <p class="w-25 p-1">
                                                <input type="number" id="quantity" class="form-control form-icon-trailing" value="1" min="1" max="<?php echo $quantity; ?>"/>
                                            </p>

                                            <div class="p-1 mb-4">
                                                <button
                                                    class="btn btn-primary btn-lg btn-block"
                                                    style="background-color: #7c4dff;"
                                                    type="submit"
                                                >
                                                    Buy
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
        </div>
    </body>

