<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
    include_once 'header.php';
?>

<main>
    <h1> Login Here </h1>
    <!--Login form-->
    <form name="login_form" id="login_form" method="post" action="process_login.php">
        <label for="username">Username:</label>
        <input type="text" name="username"><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <input type="submit" name="submit" id="submit" value="Log In">
    </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p> Fill in all fields! </p>";
        }
        else if ($_GET["error"] == "wronglogin") {
            echo "<p> Incorrect login details! </p>";
        }
        else if ($_GET["error"] == "none") {
            echo "<p> You are logged in! </p>";
        }
    }
    ?>
</main>