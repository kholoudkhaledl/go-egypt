 <?php
 session_start();
include '../config/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
   
    //  password_verify(text from form , password from db)
    // if($user && password_verify($pass, $user['pass'])){
if($user && $pass === $user['pass']){
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['Fname'] . ' ' . $user['Lname']
    ];
    // echo "<script>window.location.replace('../index.php');</script>";
    echo "<h1> regestration successful ! " . ' '.$user['Fname'] . "</h1>";
    exit();
}
else{
    $error = "invalid email or password ";
    echo "<div class='alert alert-danger text-center m-3' role='alert'> $error </div>";
}
}
?> 
