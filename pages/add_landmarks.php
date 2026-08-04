<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../include/head.php"; ?>
    <title>Add Landmark</title>
</head>

<body>

<h2>Add New Landmark</h2>

<form action="../action/add_landmarks_action.php" method="POST">

    <label>Landmark Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Location</label><br>
    <input type="text" name="location" required><br><br>

    <label>Category</label><br>
    <input type="text" name="category" required><br><br>

    <label>Image Name</label><br>
    <input type="text" name="image"><br><br>

    <button type="submit">Add Landmark</button>

</form>

</body>
</html>