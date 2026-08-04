<?php

include "../config/db.php";

$id = $_GET['id'];

$sql = "DELETE FROM landmarks WHERE id=$id";

if(mysqli_query($conn,$sql))
{
    echo "Landmark Deleted Successfully";
}
else
{
    echo "Error: " . mysqli_error($conn);
}

?>