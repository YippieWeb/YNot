<?php
session_start();

$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

$user = trim($_POST['username']);
$pass = trim($_POST['password']);

$login_query = "SELECT users.password FROM users WHERE users.username='".$user."'";
$login_result = mysqli_query($con, $login_query);
$login_record = mysqli_fetch_assoc($login_result);

$hash = trim($login_record['password']);

/*$verify = password_verify($pass, $hash);*/ /*not working*/

if($pass == $hash) {
    $_SESSION['logged_in'] = 1;
    header("Location: index.php");
    echo "Correct!";
}
else {
    echo "Incorrect Username or Password";
    header("Location: login.php");
}
?>