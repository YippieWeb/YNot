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
    <nav>
        <a class='page' href='index.php'> Home</a>
        <a class='page' href='stories.php'> Stories</a>
        <a class='page' href='signup.php'> Sign up</a>
        <a class='page' href='login.php'> Log in</a>
        <a class='page' href='process_logout.php'> Log Out</a>
    </nav>
</header>

<main>
    <h1> Sign Up Here </h1>
    <!--Sign up form-->
    <form name="signup_form" id="signup_form" method="post" action="process_signup.php">
        <!--- Ask name --->
        <label>First Name:</label>
        <input type="text" name="FName"><br>

        <label>Last Name:</label>
        <input type="text" name="LName"><br>

        <!--- Ask gender --->
        <label>Gender:</label>
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
        <label>Education Level:</label>
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
        <label>City:</label>
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
        <label>Username:</label>
        <input type="text" name="Username"><br>

        <!--- Ask password --->
        <label>Password:</label>
        <input type="password" name="Password"><br>

        <!--- Ask to repeat password --->
        <label>Repeat password:</label>
        <input type="password" name="RepeatPassword"><br>

        <input type="submit" name="submit" id="submit" value="Sign Up">
    </form>

    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p> Fill in all fields! </p>";
            }
            else if ($_GET["error"] == "invaliduid") {
                echo "<p> Choose a proper username! </p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p> Passwords don't match! </p>";
            }
            else if ($_GET["error"] == "stmtfailed") {
                echo "<p> Something went wrong, try again! </p>";
            }
            else if ($_GET["error"] == "usernametaken") {
                echo "<p> Username already taken! </p>";
            }
            else if ($_GET["error"] == "none") {
                echo "<p> You have signed up! </p>";
            }
        }
    ?>

</main>