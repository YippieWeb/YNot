<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang=""en">

<head>
    <title> YNOT </title>
    <meta charset=""utf-8">
    <link rel='stylesheet' type='text/css' href='css/style.css'>

</head>

<body>
<header>
    <h1> YNOT </h1>
    <!--- Navigation Bar -->
    <nav>
        <a class='page' href='index.php'> Home</a>
        <a class='page' href='stories.php'> Stories</a>
        <?php
            if (isset($_SESSION["username"])) {
                echo "<a class='page' href='profile.php'> Profile</a>";
                echo "<a class='page' href='process_logout.php'> Log out</a>";
            }
            else{
                echo "<a class='page' href='signup.php'> Sign up</a>";
                echo "<a class='page' href='login.php'> Log in</a>";
            }
        ?>
    </nav>
</header>