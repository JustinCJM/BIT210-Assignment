<?php

include 'includes/dbh.inc.php';

$query = 'SELECT * FROM product';

$stmt = $mysqli->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

echo '
    <div id="carouselExampleControls" class="carousel slide text-center carousel-dark" data-bs-ride="carousel">
        <div class="carousel-inner" data-aos="fade-left" data-aos-duration="2000">';

if (mysqli_num_rows($result) > 0) {
    $products = array();

    while ($datarows = mysqli_fetch_assoc($result)) {
        $avgRating = $datarows['avgRating'];
        $productID = $datarows['productID'];

        $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID AND display = 1";
        $imageResult = mysqli_query($mysqli, $imageQuery);

        $imagePath = '';
        if ($imageResult && mysqli_num_rows($imageResult) > 0) {
            $imageData = mysqli_fetch_assoc($imageResult);
            $imagePath = $imageData['image_path'];
        }

        $products[] = '
            <div class="col-md-3 mb-0 pb-4 pt-4">
                <a href="product_listing.php?productid=' . $datarows['productID'] . '" class="card-link" style="outline: none; text-decoration: none;">
                    <div class="card" style="transition: transform 0.3s ease; max-width: 24rem; margin: 0 auto;">
                        <style>
                            .card:hover {
                                transform: scale(1.03);
                            }
                            .card {
                                box-shadow: 1px 1px 10px;
                            }
                        </style>
                        <img src="' . $imagePath . '" class="card-img-top" style="max-width: 50rem; height: 20rem;" alt="Product Image">
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
                $products[count($products) - 1] .= '<li><i class="fas fa-star fa-sm"></i></li>';
            } else {
                $products[count($products) - 1] .= '<li><i class="far fa-star fa-sm"></i></li>';
            }
        }
        $products[count($products) - 1] .= '</ul>
                                    <p class="card-text mb-1" style="color: grey;">' . $datarows['quantitySold'] . ' Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>';
    }

    // Display products in groups of three
    $productGroups = array_chunk($products, 3);
    foreach ($productGroups as $key => $group) {
        echo '<div class="carousel-item ' . ($key === 0 ? 'active' : '') . '"><div class="row justify-content-center">' . implode('', $group) . '</div></div>';
    }
}

echo '
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>';
?>
