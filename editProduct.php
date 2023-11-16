<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/editProduct/editProduct_view.inc.php';

include 'includes/dbh.inc.php';

if (isset($_GET['productid'])) {
    $productID = $_GET['productid']; 
    $query = "SELECT * FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $productID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $productDetails = $result->fetch_assoc();
            } else {
                echo "Product not found.";
                exit();
            }
        } else {
            echo "Query execution failed: " . $stmt->error;
            exit();
        }
    }    
    $_SESSION['edit_product_id'] = $productID;

} elseif(isset($_SESSION['edit_product_id']) ) {
    $productID = $_SESSION['edit_product_id']; 
    $query = "SELECT * FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $productID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $productDetails = $result->fetch_assoc();
            } else {
                echo "Product not found.";
                exit();
            }
        } else {
            echo "Query execution failed: " . $stmt->error;
            exit();
        }
    }    
}else{
    echo "Product ID not provided.";
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8">
            <div class="card" style="border-radius: 1rem">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                    <form action="includes\editProduct\editProduct.inc.php" method="post" id="editProduct" class="pt-3 needs-validation was-validated"
                    novalidate="" enctype="multipart/form-data">
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                        Edit Product Details
                        </h3>

                        <div class="row">
                        
                        
                    </div>
                    <input type="hidden" name="productid" value="<?php echo $productID; ?>">
                    <div class="form-floating mb-4">
                        <input
                            name="productName"
                            class="form-control form-control-lg"
                            value = "<?php echo $productDetails['productName']; ?>"
                            required
                        />
                        <label for="formProductName">Product Name</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productPrice"
                            class="form-control form-control-lg"
                            value = "<?php echo $productDetails['productPrice']; ?>"
                            required
                        />
                        <label for="formProductPrice">Price</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productCategory"
                            class="form-control form-control-lg"
                            value = "<?php echo $productDetails['category']; ?>"
                            required
                        />
                        <label for="formProductCategory">Category</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productLocation"
                            class="form-control form-control-lg"
                            value = "<?php echo $productDetails['prodLocation']; ?>"
                            required
                        />
                        <label for="formProductLocation">Location</label>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea
                            name="productDescription"
                            class="form-control form-control-lg"
                            required
                        > <?php echo $productDetails['prodDescription']; ?></textarea>
                        <label for="formProductDescription">Description</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            type="file"
                            name="image"
                            class="form-control form-control-lg"
                            accept=".pdf,.png,.jpeg"
                        />
                        <label for="formPdfDoc">Upload Display Image</label>
                        <p style="margin-top: 10px;">Please add an image if you want to change the display image.</p>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            type="file"
                            name="images[]"
                            class="form-control form-control-lg"
                            accept=".pdf,.png,.jpeg,.jpg"
                            multiple
                        />
                        <label for="formPdfDoc">Upload Multiple Images</label>
                    </div>
                    <p style="margin-top: -10px;">Ctrl + click to select multiple images.</p>

                    <button type="submit" value="UpdateProduct" class='btn me-2 btn-lg' style='background-color:#7c4dff; color:white;'>Update Product</button>
                    <a href="merchantDashboard.php" class='btn btn-light btn-lg'>Cancel</a>
                    </form>
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

<?php
check_editProduct_errors();
$mysqli->close();
?>