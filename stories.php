<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/* query all cities */
$all_city_query="SELECT * FROM cities";
$all_city_result= mysqli_query($con,$all_city_query);
?>

<?php
/* city sorting query */
if(isset($_GET['city'])){
    $city_id=$_GET['city'];

    $this_city_query = "SELECT *
                        FROM posts, users, cities, educations, tags, genders
                        WHERE users.city_id = '".$city_id."'
                        AND posts.user_id = users.user_id
                        AND posts.tag_id = tags.tag_id
                        AND users.gender_id = genders.gender_id
                        AND users.city_id = cities.city_id
                        AND users.edu_id = educations.edu_id";
    $result = mysqli_query($con, $this_city_query);
    }

/* get the searched post */
elseif(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT *
                     FROM posts, users, cities, educations, tags, genders
                     WHERE posts.title LIKE '%$search%'
                     AND posts.user_id = users.user_id
                     AND posts.tag_id = tags.tag_id
                     AND users.gender_id = genders.gender_id
                     AND users.city_id = cities.city_id
                     AND users.edu_id = educations.edu_id";
    $result = mysqli_query($con, $search_query);
    }

/* get all the post */
else {
    $all_query = "SELECT *
                  FROM posts, users, cities, educations, tags, genders
                  WHERE posts.user_id = users.user_id
                  AND posts.tag_id = tags.tag_id
                  AND users.gender_id = genders.gender_id
                  AND users.city_id = cities.city_id
                  AND users.edu_id = educations.edu_id";
    $result = mysqli_query($con, $all_query);
}
?>

<?php
include_once 'header.php';
?>

<main class="stories-page">
    <!--search bar-->
    <form action="stories.php" method="post">
        <label for="search">
            <input type="text" name='search' placeholder="Search by title">
        </label>
        <input class="btn-1 var-2" type="submit" name="submit">
    </form><br>

    <!--city sorting filter-->
    <form name='sorting_form' id='sorting_form' method='get' action='stories.php'>
        <select id='city' name='city' class='choice'>
            <!--options-->
            <?php
            while($all_city_record=mysqli_fetch_assoc($all_city_result)){
                echo"<option value='".$all_city_record['city_id']."'>";
                echo $all_city_record['city'];
                echo"</option>";
            }
            ?>
        </select>
        <input class="btn-1 var-2" type='submit' name='sorting_button' value='Sort'>
    </form>
    <br>

    <!--refresh button-->
    <a href="stories.php">
        <button class="btn-1">Refresh page</button>
    </a>

    <?php
    if (isset($_SESSION["user_id"])) {
        echo "
        <!--- a button that allows adding post --->
    <a href=\"insert.php\">
        <button class=\"btn-1\">Add a post</button>
    </a>

    <!--- a button that allows updating/deleting post --->
    <a href=\"edit.php\">
        <button class=\"btn-1\">Edit a post</button>
    </a>";
    }
    ?>
    <br><br><br>


    <!--- posts --->
        <?php
        $count = mysqli_num_rows($result);
        if ($count == 0) /*no matches*/ {
            echo "<p>There was no search results!</p>";
            header("Refresh:1; url=stories.php");
        }
        else {
            echo "<div class=\"post-container\">";
            while ($row = mysqli_fetch_array($result)) {
                echo "
                <div class=\"post\">
                <h4><i class=\"fa-solid fa-user\"></i> " . $row['username'] . "</h4>
                <h4><i class=\"fa-solid fa-location-dot\"></i> " . $row['city'] . "</h4>
                <h4><i class=\"fa-solid fa-graduation-cap\"></i> " . $row['education'] . "</h4><br>
                <button class=\"tag\" style=\"color:".$row['text_color']."; background-color:".$row['bg_color'].";\" type=\"button\">" . $row['tag'] . "</button>
                <h2>" . $row['title'] . "</h2>
                <p>" . $row['content'] . "</p>
                </div>
                ";
            }
            echo "</div>";
        }
        ?>

</main>
</body>
