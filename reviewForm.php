<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/reviewForm/reviewForm_view.inc.php';
//require_once 'includes/reviewForm/reviewForm_contr.inc.php';

include 'includes/dbh.inc.php';

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID']; 
    $orderID = (int)$orderID;
    $query = "SELECT * FROM orders WHERE orderID = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $orderID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $orderDetails = $result->fetch_assoc();
            } else {
                echo "Order not found.";
                exit();
            }
        } else {
            echo "Query execution failed: " . $stmt->error;
            exit();
        }
    }    
    $_SESSION['review_order_id'] = $orderID;

} elseif(isset($_SESSION['review_order_id']) ) {
    $orderID = $_SESSION['review_order_id']; 
    $orderID = (int)$orderID;
    $query = "SELECT * FROM orders WHERE orderID = ?";
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $orderID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $orderDetails = $result->fetch_assoc();
            } else {
                echo "Order not found.";
                exit();
            }
        } else {
            echo "Query execution failed: " . $stmt->error;
            exit();
        }
    }    
}else{
    echo "Order ID not provided.";
    exit();
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Review</title>
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
    <style>
        .star {
            font-size: 50px;
            cursor: pointer;
            color:gray;
        }
    </style>
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

<div class="vh-120 page-body">
    <div class="container py-5">
        <div class="card" style="border-radius: 1rem">

            <?php displayOrderDetails($mysqli, $orderID);?>

            <hr class="">

            <div class="row">
                <div class="card-header px-5">
                  <h3>Submit a Review</h3>
                </div>
            </div>

            <div class="row">
                <form id="reviewForm" action="includes/reviewForm/reviewForm.inc.php" method="post" id="reviewOrder">
                    <div class="mb-3 px-5 py-3">
                        <label for="rating">Rating:</label>
                        <div>
                            <span class="star" onclick="setRating(1)">&#9733;</span>
                            <span class="star" onclick="setRating(2)">&#9733;</span>
                            <span class="star" onclick="setRating(3)">&#9733;</span>
                            <span class="star" onclick="setRating(4)">&#9733;</span>
                            <span class="star" onclick="setRating(5)">&#9733;</span>
                            <input type="hidden" name="rating" id="rating" value="0">
                        </div>
                    </div>

                    <div class="mb-3 px-5">
                        <label for="reviewComment">Comments:</label>
                        <textarea class="form-control" id="reviewComment" name="reviewComment" rows="4"></textarea>
                    </div>

                    <div class="mb-3 px-5">
                        <button type="submit" value="submitReview" class="btn btn-primary btn-lg btn-block" style="background-color: #7c4dff;">Submit Review</button>
                        <a href="customer_dashboard.php" class="btn btn-light btn-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setRating(rating) {
        document.getElementById('rating').value = rating;

        // Reset the color of all stars
        const stars = document.getElementsByClassName('star');
        for (let i = 0; i < stars.length; i++) {
            stars[i].style.color = 'grey';
        }

        // Set the color of selected stars
        for (let i = 0; i < rating; i++) {
            stars[i].style.color = 'gold';
        }
    }
</script>

</body>
<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
    <section
      class="d-flex justify-content-center p-4"
      style="background-color: #6351ce"
      >
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
      </div>
    </section>
    
      <div>
        <div class="row mt-xl-4">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold"><img src="assets/logo.png" class="smalllogo" alt="...">Travurr</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p class="fw-bold">
              Unveiling the Extraordinary
            </p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">Transport</a>
            </p>
            <p>
              <a href="#!" class="text-white">Accommodation</a>
            </p>
            <p>
              <a href="#!" class="text-white">Experiences</a>
            </p>
            <p>
              <a href="#!" class="text-white">Package Deals</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold">Quick Links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="faq.php" class="text-white">FAQ</a>
            </p>
            <p>
              <a href="contact.php" class="text-white">Contact Us</a>
            </p>
            <p>
              <a href="about.php" class="text-white">About Us</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> Tower 3, Brunsfield Oasis, Oasis Square, Jalan PJU 1A/7A, Oasis Ara Damansara, 47301 Petaling Jaya, Selangor</p>
            <p><i class="fas fa-envelope mr-3"></i> travelmate@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> +60 3845 3984</p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
        </div>
      </div>

</footer>
</html>
<?php
check_reviewOrder_errors();
$mysqli->close();
?>