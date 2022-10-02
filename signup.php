<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*Gender Query*/
/*SELECT gender_id, gender FROM genders*/
$all_gender_query = "SELECT gender_id, gender FROM genders";
$all_gender_result = mysqli_query($con, $all_gender_query);

/*City Query*/
/*SELECT city_id, city FROM cities*/
$all_city_query = "SELECT city_id, city FROM cities";
$all_city_result = mysqli_query($con, $all_city_query);

/*Education Query*/
/*SELECT edu_id, education FROM educations*/
$all_edu_query = "SELECT edu_id, education FROM educations";
$all_edu_result = mysqli_query($con, $all_edu_query);
?>

<?php
include_once 'header.php';
?>

<main>
    <h1> Welcome to YNot. </h1>
    <p class="ins">Create an account or<a href="login.php">log in</a></p>

    <div class="sign-up-form">
    <!--Sign up form-->
    <form name="signup_form" id="signup_form" method="post" action="process_signup.php">
        <!--- Ask name --->
        <label>First Name:</label><br>
        <input type="text" name="FName"><br>

        <label>Last Name:</label><br>
        <input type="text" name="LName"><br>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "invalidname") {
                echo "<h4> Please enter a valid name. </h4>";
            }
        }
        ?>

        <!--- Ask gender --->
        <label>Gender:</label><br>
        <select id='gender' name="Gender" class='choice'>
            <!--- gender options --->
            <?php
            while($all_gender_record=mysqli_fetch_assoc($all_gender_result)){
                echo"<option value='".$all_gender_record['gender_id']."'>";
                echo $all_gender_record['gender'];
                echo"</option>";
            }
            ?>
        </select><br>

        <!--- Ask education level --->
        <label>Education Level:</label><br>
        <select id='edu' name="Edu" class='choice'>
            <!--- edu level options --->
            <?php
            while($all_edu_record=mysqli_fetch_assoc($all_edu_result)){
                echo"<option value='".$all_edu_record['edu_id']."'>";
                echo $all_edu_record['education'];
                echo"</option>";
            }
            ?>
        </select><br>

        <!--- Ask city (drop-down) --->
        <label>City:</label><br>
        <select id='city' name="City" class='choice'>
            <!--- city options --->
            <?php
            while($all_city_record=mysqli_fetch_assoc($all_city_result)){
                echo"<option value='".$all_city_record['city_id']."'>";
                echo $all_city_record['city'];
                echo"</option>";
            }
            ?>
        </select><br>

        <!--- Ask username --->
        <label>Username:</label><br>
        <input type="text" name="Username"><br>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "invaliduid") {
                echo "<h4> Only letters and numbers allowed in username! </h4>";
            }
        else if ($_GET["error"] == "usernametaken") {
                echo "<h4> Username already taken! </h4>";
            }
        }
        ?>

        <!--- Ask password --->
        <label>Password:</label><br>
        <input type="password" name="Password"><br>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "badpassword") {
                echo "<h4> Password must contain a minimum of eight characters, one uppercase letter, <br>
                      one number, and one special character.</h4>";
            }
        }
        ?>

        <!--- Ask to repeat password --->
        <label>Repeat password:</label><br>
        <input type="password" name="RepeatPassword"><br><br>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "passwordsdontmatch") {
                echo "<h4> Passwords don't match! </h4>";
            }
        }
        ?>

        <input class="btn-1 var-1" type="submit" name="submit" id="submit" value="Sign Up">
    </form>
    </div>

    <!--- General errors -->
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") { // prevent empty input
                echo "<h4> Fill in all fields! </h4>";
            }
            else if ($_GET["error"] == "stmtfailed") { // backend dysfunction
                echo "<h4> Something went wrong, try again! </h4>";
            }

            else if ($_GET["error"] == "none") { // no error, allow sign up
                echo "<h4> You have signed up! </h4>";
                header("Refresh:0.5; url=login.php");
            }
        }
    ?>


</main>