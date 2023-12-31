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
                echo "<tr>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'><img src='".$imagePath."' alt='Product Image' style='width: 15rem; height: 10rem;'></td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>{$productRows['productName']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>{$productRows['category']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>{$productRows['prodLocation']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>" . number_format($productRows['productPrice'], 2) . "</td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>{$productRows['prodDescription']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center; padding: 2rem;'>
                        <a href='editProduct.php?productid={$productID}' class='btn me-2' style='background-color:#7c4dff; color:white; width:5rem;'>Edit</a>
                        <a href='deleteProduct.php?productID={$productID}'class='btn btn-light' style='width:5rem;''>Delete</a>
                        </td>";
                        echo "</tr>";
            }

            echo '</div>';
        } else {
            echo 'No results found.';
        }
    }
}


function getImagePath($mysqli, $productID) {
    $imagePath = '';

    $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID AND display=1";
    $imageResult = mysqli_query($mysqli, $imageQuery);

    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
        $imageData = mysqli_fetch_assoc($imageResult);
        $imagePath = $imageData['image_path'];
    }

    return $imagePath;
}
