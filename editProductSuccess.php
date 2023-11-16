<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Success</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
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
    <link
      rel="stylesheet"
      href="style.css"
    />
  </head>
  <body>
        <?php
            require_once 'includes/dbh.inc.php';
            $productID= $_SESSION['edit_product_id'];
            $query = "SELECT * FROM product WHERE productID = $productID ";
            $displayImageQuery = "SELECT image_path FROM product_images WHERE productID = $productID AND display = 1";
            $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID AND display = 0;";

            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = mysqli_fetch_assoc($stmt->get_result());
            
            $name = $result['productName'];
            $price = number_format($result['productPrice'], 2);
            $description = $result['prodDescription'];
            $location = $result['prodLocation'];
            $category = $result['category'];

            $displayResult = mysqli_query($mysqli, $displayImageQuery);
            $displayPath = '';
            if ($displayResult && mysqli_num_rows($displayResult) > 0) {
                $displayData = mysqli_fetch_assoc($displayResult);
                $displayPath = $displayData['image_path'];
            }

            $imageResult = mysqli_query($mysqli, $imageQuery);
            $imagePath = mysqli_fetch_all($imageResult, MYSQLI_ASSOC);

        ?>


        <div class="page-body">
            <div class="container py-5" style="height: 90%">
            <div class="alert alert-success" role="alert">
              You have Successfully Edited a Product!
            </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card mb-5 py-3" style="border-radius: 1rem">
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
                                                $image_path = $image["image_path"];
                                                echo    "<div class='d-md-block p-2 align-items-center'>
                                                            <img id='prodImg' src='$image_path' class='card-img-top' alt='Product Image'>
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
                                      <div class="col">
                                      <h3 style="letter-spacing: 1px">
                                            Price: 
                                        </h3>
                                      </div>
                                      <div class="col">
                                      <h3 class="fw-normal pb-3" style="letter-spacing: 1px; margin-right: 50px;">RM<?php echo $price; ?></h3>
                                      </div>
                                    </div>

                                    <div class="row g-0">
                                      <div class="col">
                                      <h3 style="letter-spacing: 1px">
                                            Description: 
                                        </h3>
                                      </div>
                                      <div class="col">
                                      <h3 class="fw-normal pb-3" style="letter-spacing: 1px; margin-right: 50px;"><?php echo $description; ?></h3>
                                      </div>
                                    </div>

                                    <div class="row g-0">
                                      <div class="col">
                                      <h3 style="letter-spacing: 1px">
                                            Location: 
                                        </h3>
                                      </div>
                                      <div class="col">
                                      <h3 class="fw-normal pb-3" style="letter-spacing: 1px; margin-right: 50px;"><?php echo $location; ?></h3>
                                      </div>
                                    </div>

                                    <div class="row g-0">
                                      <div class="col">
                                      <h3 style="letter-spacing: 1px">
                                            Category: 
                                        </h3>
                                      </div>
                                      <div class="col">
                                      <h3 class="fw-normal pb-3" style="letter-spacing: 1px; margin-right: 50px;"><?php echo $category; ?></h3>
                                      </div>
                                    </div>
                                </div>
                                
                            </div>
                            <a href="merchantDashboard.php" class='btn me-2 btn-lg btn-block' style='background-color:#7c4dff; color:white;'>Return to Dashboard</a>
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
  <body>

    <script>
        // JavaScript to redirect after 4 seconds
        //setTimeout(function() {
          //  window.location.href = 'merchantDashboard.php';
        //}, 2000);  
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
