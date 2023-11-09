<?php
require_once 'includes/config_session.inc.php';

include 'includes/dbh.inc.php';

if (isset($_GET['productid'])) {
    $productID = $_GET['productid'];

    // Fetch product details from the database based on the product ID
    $query = "SELECT * FROM product WHERE productID = ?";
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $productID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $productDetails = $result->fetch_assoc();

                $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID";
                $imageResult = mysqli_query($mysqli, $imageQuery);
        
                $imagePath = '';
                    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                    $imageData = mysqli_fetch_assoc($imageResult);
                    $imagePath = $imageData['image_path'];
                    }
            } else {
                echo "Product not found.";
                exit();
            }
        } else {
            echo "Query execution failed: " . $stmt->error;
            exit();
        }
    }
} else {
    echo "Product ID not provided.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script>
        function confirmDelete() {
            var confirmation = confirm("Are you sure you want to delete this product?");
            if (confirmation) {
                // If the user confirms, proceed with the deletion
                window.location.href = 'delete_product.php?productid=<?php echo $productID; ?>';
            }
        }
    </script>
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
<div class="vh-100 d-flex align-items-center justify-content-center page-body">
    <div class="container py-5">
        <div class="card text-center"style="height: 600px;">
            <div class="card-header">
            <h1>Delete Product</h1> 
            
            </div>
            
            <div class="card-body">
            <img src="<?php echo $imagePath ?>" class="card-img-top-centre" style="max-width: 50rem; height: 20rem;" alt="Product Image">
                <p class="card-text">Product Name: <?php echo $productDetails['productName']; ?></p>
                <p class="card-text">Product Price: RM<?php echo number_format($productDetails['productPrice'], 2); ?></p>
                <p class="card-text">Product Location: <?php echo $productDetails['prodLocation']; ?></p>
            </div>
            <div class="card-footer text-muted">
            <button class="btn btn-danger btn-lg" onclick="confirmDelete()">Confirm Delete</button>
            <a href="#" class="btn btn-primary btn-lg" onclick="history.back()">Cancel</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>

<?php
$mysqli->close();
?>