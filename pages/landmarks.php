<?php
include "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/head.php"; ?>
    <title>Landmarks</title>
</head>

<body>

<h2>All Landmarks</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Location</th>
    <th>Category</th>
    <th>Image</th>
    <th>Action</th>
</tr>

<?php

$sql = "SELECT * FROM landmarks";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['category']; ?></td>
<td><?php echo $row['image']; ?></td>

<td>
    <a href="edit_landmarks.php?id=<?php echo $row['id']; ?>">Edit</a> |

    <a href="../action/delete_landmarks.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure?')">
       Delete
    </a>
</td>
</tr>

<?php
}
?>

</table>

</body>
</html>