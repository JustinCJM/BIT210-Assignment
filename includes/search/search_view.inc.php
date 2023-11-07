<?php

declare(strict_types=1);

function displayTable($result) {
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            echo '<div class="row">';
            
            while ($datarows = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="product_image.jpg" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">' . $datarows['productName'] . '</h5>
                            <p class="card-text">Price: $' . $datarows['productPrice'] . '</p>
                            <p class="card-text">Location: ' . $datarows['prodLocation'] . '</p>
                            <p class="card-text">' . $datarows['prodDescription'] . '</p>
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

