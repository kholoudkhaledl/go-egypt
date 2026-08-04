<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/head.php"; ?>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form action="../action/login_action.php" method="POST">

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>