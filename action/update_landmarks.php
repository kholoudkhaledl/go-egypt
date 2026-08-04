<?php

include "../config/db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$location = $_POST['location'];
$category = $_POST['category'];
$image = $_POST['image'];

$sql = "UPDATE landmarks SET
name='$name',
description='$description',
location='$location',
category='$category',
image='$image'
WHERE id=$id";

if(mysqli_query($conn, $sql))
{
    echo "Landmark Updated Successfully";
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>