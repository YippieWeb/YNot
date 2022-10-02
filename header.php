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
    <script src="https://kit.fontawesome.com/af9d7d3ea3.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' href='css/style.css'>

</head>

<body>
<header>
    <a class='page' href='index.php'>
        <h1> YNOT </h1>
    </a>
    <!--- Navigation Bar -->
    <nav>
        <a class='page' href='stories.php'> Stories</a>
        <?php
            if (isset($_SESSION["username"])) {
                echo "<i class=\"fa-regular fa-user\"></i>";
                echo "<a class='page' href='profile.php'>".$_SESSION["username"]."</a>";
                echo "<a class='page' href='process_logout.php'><button class=\"btn-1\"> Log out</button></a>";
            }
            else{
                echo "<a class='page' href='signup.php'><button class=\"btn-1\"> Sign up </button></a>";
                echo "<a class='page' href='login.php'><button class=\"btn-2\"> Log in </button></a>";
            }
        ?>
    </nav>
</header>