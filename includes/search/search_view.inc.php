<?php

declare(strict_types=1);

function displayTable($result) {

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            echo '<div class="row">';
            
            while ($datarows = mysqli_fetch_assoc($result)) {

                include 'includes/dbh.inc.php';

                $avgRating = $datarows['avgRating'];
                $productID = $datarows['productID'];

                $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID AND display = 1";
                $imageResult = mysqli_query($mysqli, $imageQuery);
        
                $imagePath = '';
                    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                    $imageData = mysqli_fetch_assoc($imageResult);
                    $imagePath = $imageData['image_path'];
                    }

                echo '
                <div class="col-md-4 mb-2 pb-4 pt-4">
                    <a href="product_listing.php?productid='.$datarows['productID'].'" class="card-link" style="outline: none; text-decoration: none;">
                        <div class="card" style="transition: transform 0.3s ease; max-width: 24rem;">
                            <style>
                                .card:hover {
                                    transform: scale(1.03);
                                }
                                .card {
                                    box-shadow: 1px 1px 10px ;
                                }
                            </style>
                            <img src="'. $imagePath .'" class="card-img-top" style="max-width: 50rem; height: 20rem;" alt="Product Image">
                            <div class="card-body">
                                <p class="card-text" style="color: grey;">' . $datarows['prodLocation'] . ' | ' . $datarows['category'] . '</p>
                                <h5 class="card-title">' . $datarows['productName'] . '</h5>
                                <hr class= "my-4">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <p class="card-text fs-3" style="color: #7c4dff; font-weight: 600;">RM' . number_format($datarows['productPrice'], 2) . '</p>
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled d-flex justify-content-center text-warning me-2 mb-2">
                                            <div class="me-1">' . $avgRating . '</div>';
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $avgRating) {
                                                    echo '<li><i class="fas fa-star fa-sm"></i></li>';
                                                } else {
                                                    echo '<li><i class="far fa-star fa-sm"></i></li>';
                                                }
                                            }
                                        echo '</ul>
                                        <p class="card-text mb-1" style="color: grey;">' . $datarows['quantitySold'] . ' Sold</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                ';
            }

            echo '</div>';
        } else {
            echo 'No results found.';
        }
    }
}

