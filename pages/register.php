<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../include/head.php"; ?>
    <title>Register</title>
</head>

<body>

<h2>Create Account</h2>

<form action="../action/register_action.php" method="POST">

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>

</form>

</body>
</html>