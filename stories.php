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

    $this_city_query = "SELECT users.username, cities.city, genders.gender, educations.education, tags.tag, posts.title, posts.content
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
    $search_query = "SELECT users.username, cities.city, genders.gender, educations.education, tags.tag, posts.title, posts.content
                     FROM posts, users, cities, educations, tags, genders
                     WHERE users.username LIKE '%$search%'
                     AND posts.user_id = users.user_id
                     AND posts.tag_id = tags.tag_id
                     AND users.gender_id = genders.gender_id
                     AND users.city_id = cities.city_id
                     AND users.edu_id = educations.edu_id";
    $result = mysqli_query($con, $search_query);
    }

/* get all the post */
else {
    $all_query = "SELECT users.username, cities.city, genders.gender, educations.education, tags.tag, posts.title, posts.content
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

<main>
    <!--search bar-->
    <form action="stories.php" method="post">
        <label for="search">
            <input type="text" name='search' placeholder="Search by name">
        </label>
        <input type="submit" name="submit">
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
        <input type='submit' name='sorting_button' value='Sort'>
    </form><br>

    <!--refresh button-->
    <a href="stories.php">
        <button>Refresh page</button>
    </a>

    <!--- a button that allows adding post --->
    <a href="insert.php">
        <button>Add a post</button>
    </a>

    <!--- a button that allows updating/deleting post --->
    <a href="edit.php">
        <button>Edit a post</button>
    </a>

    <!--stories table-->
        <?php
            $count = mysqli_num_rows($result);
            if ($count == 0) /*no matches*/ {
                echo "<p>There was no search results!</p>";
                header("Refresh:1; url=stories.php");
            }
            else {
                echo "
                <table align=center class='content-table'>
                    <tr>
                        <th> Username</th>
                        <th> City</th>
                        <th> Education</th>
                        <th> Tag</th>
                        <th> Title</th>
                        <th> Content</th>
                    </tr>";

                while ($row = mysqli_fetch_array($result)) {
                    /* set name to 'Anonymous' if null
                    if (empty($row['name'])) {
                        $row['name'] = "Anonymous";
                    }*/

                    /* iterate and display all info */
                    echo ' <tr> 
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['city'] . '</td>
                    <td>' . $row['education'] . '</td>
                    <td>' . $row['tag'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['content'] . '</td>
                    </tr>';
                }
            }
        ?>
        </table>

</main>
</body>
