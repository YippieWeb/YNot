<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*Country Query*/
/*SELECT country_id, country FROM countries*/
$all_countries_query = "SELECT country_id, country FROM countries";
$all_countries_result = mysqli_query($con, $all_countries_query);

/*Classification Query*/
/*SELECT class_id, classification FROM classifications*/
$all_classes_query = "SELECT class_id, classification FROM classifications";
$all_classes_result = mysqli_query($con, $all_classes_query);

/*Job Type Query*/
/*SELECT type_id, type FROM types*/
$all_types_query = "SELECT type_id, type FROM types";
$all_types_result = mysqli_query($con, $all_types_query);

/*Education Query*/
/*SELECT edu_id, education FROM educations*/
$all_educations_query = "SELECT edu_id, education FROM educations";
$all_educations_result = mysqli_query($con, $all_educations_query);
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
    <h2> Add post </h2>
    <div id="container">
        <br>
        <!-------------------------------------- Add post form -------------------------------------->
        <form method='post' action='process_insert.php'>
            <!--- Ask name --->
            <label> Name: </label>
            <input type="text" name="Name"><br>

            <!--- Ask city --->
            <label> City: </label>
            <input type="text" name="City"><br>

            <!--- Ask country (drop-down) --->
            <label> Country: </label>
            <select id='country' name='Country' class='choice'>
                <!--- country options --->
                <?php
                while($all_countries_record=mysqli_fetch_assoc($all_countries_result)){
                    echo"<option value='".$all_countries_record['country_id']."'>";
                    echo $all_countries_record['country'];
                    echo"</option>";
                }
                ?>
            </select><br>

            <!--- Ask classification (drop-down) --->
            <label> Classification: </label>
            <select id='Classification' name='Classification' class='choice'>
                <!--- classification options --->
                <?php
                while($all_classes_record=mysqli_fetch_assoc($all_classes_result)){
                    echo"<option value='".$all_classes_record['class_id']."'>";
                    echo $all_classes_record['classification'];
                    echo"</option>";
                }
                ?>
            </select><br>

            <!--- Ask job type (drop-down) --->
            <label> Type: </label>
            <select id='Type' name='Type' class='choice'>
                <!--- job type options --->
                <?php
                while($all_types_record=mysqli_fetch_assoc($all_types_result)){
                    echo"<option value='".$all_types_record['type_id']."'>";
                    echo $all_types_record['type'];
                    echo"</option>";
                }
                ?>
            </select><br>

            <!--- Ask education (drop-down) --->
            <label> Education: </label>
            <select id='Education' name='Education' class='choice'>
                <!--- education options --->
                <?php
                while($all_educations_record=mysqli_fetch_assoc($all_educations_result)){
                    echo"<option value='".$all_educations_record['edu_id']."'>";
                    echo $all_educations_record['education'];
                    echo"</option>";
                }
                ?>
            </select><br>

            <!--- Ask post title --->
            <label> Title: </label>
            <input type="text" name="Title"><br>

            <!--- Ask post content --->
            <label> Content: </label>
            <input type="text" name="Content" placeholder = "Write Something"><br>

            <input type='submit' value='Insert'>
        </form>
        <!-------------------------------------- Add post form -------------------------------------->
    </div>
</main>