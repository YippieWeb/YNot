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
    <div class="login-form">
    <!--Login form-->
    <form name="login_form" id="login_form" method="post" action="process_login.php">
        <label for="username">Username:</label><br>
        <input type="text" name="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password"><br><br>

        <input class="btn-1 var-1" type="submit" name="submit" id="submit" value="Log In">
    </form>
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h4> Fill in all fields! </h4>";
        }
        else if ($_GET["error"] == "wronglogin") {
            echo "<h4> Incorrect login details! </h4>";
        }
        else if ($_GET["error"] == "none") {
            echo "<h4> You are logged in! </h4>";
        }
    }
    ?>

</main>