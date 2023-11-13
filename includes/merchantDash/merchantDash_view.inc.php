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
                        echo "<td><img src='".$imagePath."' alt='Product Image' style='width: 15rem; height: 10rem;'></td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>{$productRows['productName']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>{$productRows['category']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>{$productRows['prodLocation']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>" . number_format($productRows['productPrice'], 2) . "</td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>{$productRows['prodDescription']}</td>";
                        echo "<td style='vertical-align: middle; text-align: center;'>
                        <a href='editProduct.php?productid={$productID}' class='btn btn-primary'>Edit</a>
                        <a href='deleteProduct.php?productID={$productID}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
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

    $imageQuery = "SELECT image_path FROM product_images WHERE productID = $productID";
    $imageResult = mysqli_query($mysqli, $imageQuery);

    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
        $imageData = mysqli_fetch_assoc($imageResult);
        $imagePath = $imageData['image_path'];
    }

    return $imagePath;
}
