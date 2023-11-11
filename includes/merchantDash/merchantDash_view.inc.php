<?php

declare(strict_types=1);

function displayProducts($mysqli) {
    $result = getProducts($mysqli);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="row">';
            
            while ($productRows = mysqli_fetch_assoc($result)) {
                $productID = $productRows['productID'];

                // Fetch image path
                $imagePath = getImagePath($mysqli, $productID);

                // Display product
                echo '
                <div class="col-md-4 mb-4">
                    <div class="shadow-lg card" style="transition: transform 0.3s ease;">
                        <style>
                            .card:hover {
                                transform: scale(1.03);
                            }
                        </style>
                        <img src="'. $imagePath .'" class="card-img-top" style="max-width: 50rem; height: 20rem;" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">' . $productRows['productName'] . '</h5>
                            <p class="card-text">Price: RM' . number_format($productRows['productPrice'], 2) . '</p>
                            <p class="card-text">Location: ' . $productRows['prodLocation'] . '</p>
                            <p class="card-text">Category: ' . $productRows['category'] . '</p>
                            <a href="editProduct.php?productid='.$productID.'" class="btn btn-primary btn-lg">Edit</a>
                            <a href="deleteProduct.php?productid='.$productID.'" class="btn btn-danger btn-lg">Delete</a>
                        </div>
                    </div>
                </div>
                ';
            }

            echo '</div>';
        } else {
            echo 'No results found.';
        }
    }
}


function getImagePath($mysqli, $productID) {
    $imagePath = '';

    $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID";
    $imageResult = mysqli_query($mysqli, $imageQuery);

    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
        $imageData = mysqli_fetch_assoc($imageResult);
        $imagePath = $imageData['image_path'];
    }

    return $imagePath;
}
