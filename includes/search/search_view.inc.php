<?php

declare(strict_types=1);

function displayTable($result) {
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            echo '<div class="row">';
            
            while ($datarows = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-md-4 mb-4">
                    <a href="product_listing.php?productid='.$datarows['productID'].'" class="card-link" style="outline: none; text-decoration: none;">
                        <div class="card" style="transition: transform 0.3s ease;">
                            <style>
                                .card:hover {
                                    transform: scale(1.03);
                                }
                            </style>
                            <img src="product_image.jpg" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">' . $datarows['productName'] . '</h5>
                                <p class="card-text">Price: RM' . number_format($datarows['productPrice'], 2) . '</p>
                                <p class="card-text">Location: ' . $datarows['prodLocation'] . '</p>
                                <p class="card-text">' . $datarows['prodDescription'] . '</p>
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

