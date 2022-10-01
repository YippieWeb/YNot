<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
include_once 'header.php';
?>

<main>
    <!--Hero-->
    <section class="hero home">
        <div class="intro">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<h1> Welcome, " . $_SESSION["username"] . ".</h1>";
            } else {
                echo "<h1> Welcome to the YNot tribe!</h1>";
            }
            ?>
            <p>Join a group of ambitious, job-ready teenagers on their early journey of career exploration.</p>
        </div>
    </section>
</main>
