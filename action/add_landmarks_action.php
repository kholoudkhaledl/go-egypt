<?php

include "../config/db.php";

$name = $_POST['name'];
$description = $_POST['description'];
$location = $_POST['location'];
$category = $_POST['category'];
$image = $_POST['image'];

$sql = "INSERT INTO landmarks (name, description, location, category, image)
VALUES ('$name', '$description', '$location', '$category', '$image')";

if (mysqli_query($conn, $sql)) {
    echo "Landmark Added Successfully";
} else {
    echo "Error: " . mysqli_error($conn);
}

?>