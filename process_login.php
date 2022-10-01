<?php
/*session_start();*/

$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

/* check if log in through submitting form */
if (isset($_POST["submit"])) {

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    require_once 'functions.php';

    /* catch empty input */
    if(emptyInputLogIn($user, $pass) !== false) {
        header("location: login.php?error=emptyinput");
        exit();
    }

    loginUser($con, $user, $pass);
}
else{
    header("location: login.php");
    exit();
}
?>