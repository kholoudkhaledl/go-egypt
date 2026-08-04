<?php
include "../config/db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM landmarks WHERE id = $id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/head.php"; ?>
    <title>Edit Landmark</title>
</head>
<body>

<h2>Edit Landmark</h2>

<form action="../action/update_landmarks.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Name</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    <label>Description</label><br>
    <textarea name="description"><?php echo $row['description']; ?></textarea><br><br>

    <label>Location</label><br>
    <input type="text" name="location" value="<?php echo $row['location']; ?>"><br><br>

    <label>Category</label><br>
    <input type="text" name="category" value="<?php echo $row['category']; ?>"><br><br>

    <label>Image</label><br>
    <input type="text" name="image" value="<?php echo $row['image']; ?>"><br><br>

    <button type="submit">Update</button>

</form>

</body>
</html>