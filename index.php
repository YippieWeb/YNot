<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<!DOCTYPE html>
<html lang=""en">

<head>
    <title> YNOT </title>
    <meta charset=""utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>

</head>

<body>
<header>
    <h1> YNOT </h1>
    <nav>
        <a class='page' href='index.php'> Home</a>
        <a class='page' href='stories.php'> Stories</a>
        <a class='page' href='login.php'> Log in</a>
        <a class='page' href='process_logout.php'> Log Out</a>
    </nav>
</header>

<main>
    <h1> Welcome to the YNot tribe </h1>
    <div>
        <p>Join a group of ambitious, job-ready teenagers on their early journey of career exploration.</p>
    </div>
</main>
