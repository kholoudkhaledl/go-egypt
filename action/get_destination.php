<?php

// receive filters coming from front end 
// $category = isset($_GET['category']) ? $_GET['category'] : '';
// $region   = isset($_GET['region']) ? $_GET['region'] : '';


// $sql = "SELECT * FROM destinations WHERE 1=1";

// if (!empty($category) && $category !== 'ALL') {
//     $category_clean = $conn->real_escape_string($category);
//     $sql .= " AND category = '$category_clean'";
// }

// if (!empty($region) && $region !== 'ALL') {
//     $region_clean = $conn->real_escape_string($region);
//     $sql .= " AND region = '$region_clean'";
// }

// $result = $conn->query($sql);
// $data = [];

// if ($result && $result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// }

// header('Content-Type: application/json; charset=utf-8');
// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// $conn->close();

include '../config/db.php';
$category = $_GET['category'] ?? '';
$region   = $_GET['region'] ?? '';


$sql = "SELECT * FROM destinations WHERE 1=1 ";

if ($category && $category !== 'ALL') {
    $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
}

if ($region && $region !== 'ALL') {
    $sql .= " AND region = '" . $conn->real_escape_string($region) . "'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    echo "
    <div class='col-md-3 mb-3'>
       <div class='card'>
       <img src='" . htmlspecialchars($row['img_url']) . "' alt='" . htmlspecialchars($row['title']) . "'>
       <div class='card-overlay'>
        <span class='badge'>" . htmlspecialchars($row['category']) . "</span>
        <h3 class='card-title'>" . htmlspecialchars($row['title']) . "</h3>
        <p class='card-desc'>" . htmlspecialchars($row['description']) . "</p>
    </div>
    </div>
    </div>";
    }
} else {
    echo "<p class='no-result'>No results found matching your filters .</p>";
}

$conn->close();

?>