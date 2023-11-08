<?php
require_once 'includes/manageProduct/manageProduct_view.inc.php';
require_once 'includes/config_session.inc.php';
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
                    <form action="includes/manageProduct/manageProduct.inc.php" method="post" id="addProduct" class="pt-3 needs-validation was-validated"
                    novalidate="" enctype="multipart/form-data">
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                        Add New Product
                        </h3>

                        <div class="row">
                        
                        
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productName"
                            class="form-control form-control-lg"
                            placeholder="Product Name"
                            required
                        />
                        <label for="formProductName">Product Name</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productPrice"
                            class="form-control form-control-lg"
                            placeholder="Price"
                            required
                        />
                        <label for="formProductPrice">Price</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productCategory"
                            class="form-control form-control-lg"
                            placeholder="Category"
                            required
                        />
                        <label for="formProductCategory">Category</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            name="productLocation"
                            class="form-control form-control-lg"
                            placeholder="Location"
                            required
                        />
                        <label for="formProductLocation">Location</label>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea
                            name="productDescription"
                            class="form-control form-control-lg"
                            placeholder="Description"
                            required
                        ></textarea>
                        <label for="formProductDescription">Description</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input
                            type="file"
                            name="image"
                            class="form-control form-control-lg"
                            accept=".pdf,.png,.jpeg"
                            required
                        />
                        <label for="formPdfDoc">Upload Image</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <?php 
    check_addProduct_errors();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
