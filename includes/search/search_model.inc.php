<?php

declare(strict_types = 1);

function search_method(object $mysqli, string $input) {
    $query = "SELECT * FROM product WHERE productName LIKE ? OR category LIKE ? OR prodLocation LIKE ?";

    $searchTerm = '%' . $input . '%';

    // Assuming you have a database connection in $mysqli
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    displayTable($result);
    
    // Process the results...
}
