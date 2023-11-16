<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Catalog</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
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

        $productID = $_GET['productid'];
        $sql = "SELECT product.productName, product.productPrice, product_images.image_path, product.category, product.prodDescription
                FROM product 
                LEFT JOIN product_images ON product.productID = product_images.productID
                WHERE product.productID = $productID";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $mysqli->close();
    ?>  

    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> 
                                    <img id="main-image" src="<?php echo $row['image_path']?>" width="250" /> 
                                </div>
                                <div class="thumbnail text-center"> 
                                    <img onclick="change_image(this)" src="<?php echo $row['image_path']?>" width="70"> 
                                    <img onclick="change_image(this)" src="<?php echo $row['image_path']?>" width="70"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="Kproductcatalog.php" class="link-info">Back</a>
                                </div>
                                <div class="mt-4 mb-3"> 
                                    <span class="text-uppercase text-muted brand"><?php echo $row['category']?></span>
                                    <br>
                                    <h5 class="text-uppercase"><?php echo $row['productName']?></h5>
                                    <div class="price d-flex flex-row align-items-center"> 
                                        <span class="act-price">RM<?php echo $row['productPrice']?></span>
                                    </div>
                                </div>
                                <p class="about"><?php echo $row['prodDescription']?></p>
                                <div class="cart mt-4 align-items-center"> 
                                    <button onclick="window.location.href='Kpayment.php?productid=<?php echo urlencode($_GET['productid']); ?>'" class="btn btn-danger text-uppercase mr-2 px-4">Checkout</button>
                                    <i class="fa fa-heart text-muted"></i> 
                                    <i class="fa fa-share-alt text-muted"></i> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>    
        function change_image(image) {
            var container = document.getElementById("main-image");
            container.src = image.src;
        }
    });
});
    
// Create a Checkout Session with the selected product
const createCheckoutSession = function (stripe) {
    return fetch("Kpayment_init.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            createCheckoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
    
    setLoading(false);
};

// Show a spinner on payment processing
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
	
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
	
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
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
    </script>
</body>
</html>
