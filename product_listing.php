<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
    <style>
        #disImg {
            display: block;
            max-height:500px;
            width: auto;
            height: auto;
        }    
        #prodImg {
            display: block;
            max-height:200px;
            width: auto;
            height: auto;
            aspect-ratio: 16/9;
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
            $displayImageQuery = "SELECT image_path FROM product_images WHERE productID = $id AND display = 1";
            $imageQuery = "SELECT image_path FROM product_images WHERE productID = $id AND display = 0;";

            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = mysqli_fetch_assoc($stmt->get_result());
            // var_dump($result);
            
            $name = $result['productName'];
            $price = number_format($result['productPrice'], 2);
            $description = $result['prodDescription'];

            $displayResult = mysqli_query($mysqli, $displayImageQuery);
            $displayPath = '';
                    if ($displayResult && mysqli_num_rows($displayResult) > 0) {
                        $displayData = mysqli_fetch_assoc($displayResult);
                        $displayPath = $displayData['image_path'];
                    }

            $imageResult = mysqli_query($mysqli, $imageQuery);
            $imagePath = [];
            
            while ($row = mysqli_fetch_assoc($imageResult)) {
                foreach ($row as $r) {
                    $imagePath[] = '' . $r;
                }
            }
        ?>


        <div class="page-body">
            <div class="container py-5" style="height: 90%">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card" style="border-radius: 1rem">
                        <div class="row g-0">
                            <h1 class="mb-2 p-5" style="letter-spacing: 1px;">
                                <b><?php echo $name; ?></b>
                            </h1>
                            <div class="card-body p-2 px-5 pb-5" style="margin-top:-25px;">
                                <div class="row g-0">
                                    <div class="col-md-9 col-lg-8 p-1 d-md-flex d-md-block" style="margin-right: 5px;">
                                        <div class="d-md-flex d-md-block align-items-center">
                                            <img id="disImg" src="<?php echo $displayPath; ?>" class="card-img-top center" alt="Product Image">
                                        </div>
                                    </div>
                                    <div class="row col-md-3 col-lg-4 d-md-block" style="overflow-y: auto; max-height: 500px;">
                                        <?php
                                            foreach ($imagePath as $image) {
                                                echo    "<div class='d-md-block p-2 align-items-center'>
                                                            <img id='prodImg' src='$image' class='card-img-top' alt='Product Image'>
                                                        </div>";
                                            }
                                        ?>
                                    </div>
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
                                                <input type="number" id="quantity" class="form-control form-icon-trailing" value="1" min="1">
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

