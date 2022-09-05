<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/* query all classifications */
$all_class_query="SELECT * FROM classifications";
$all_class_result= mysqli_query($con,$all_class_query);
?>

<?php
/* classification sorting query */
if(isset($_GET['class'])){
    $class_id=$_GET['class'];

    $this_class_query = "SELECT * 
        FROM notes, countries, classifications, types, educations
        WHERE notes.class_id = '".$class_id."'
        AND notes.country_id = countries.country_id
        AND notes.class_id = classifications.class_id
        AND notes.type_id = types.type_id
        AND notes.edu_id = educations.edu_id";
    $result = mysqli_query($con, $this_class_query);
    }

/* get the searched post */
elseif(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT *  
                     FROM notes, countries, classifications, types, educations
                     WHERE notes.name LIKE '%$search%'
                     AND notes.country_id = countries.country_id
                     AND notes.class_id = classifications.class_id
                     AND notes.type_id = types.type_id
                     AND notes.edu_id = educations.edu_id";
    $result = mysqli_query($con, $search_query);
    }

/* get all the post */
else {
    $all_query = "SELECT *  
                  FROM notes, countries, classifications, types, educations
                  WHERE notes.country_id = countries.country_id
                  AND notes.class_id = classifications.class_id
                  AND notes.type_id = types.type_id
                  AND notes.edu_id = educations.edu_id";
    $result = mysqli_query($con, $all_query);
}
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
    <!--search bar-->
    <form action="stories.php" method="post">
        <label for="search">
            <input type="text" name='search' placeholder="Search by name">
        </label>
        <input type="submit" name="submit">
    </form><br>

    <!--classification sorting filter-->
    <form name='sorting_form' id='sorting_form' method='get' action='stories.php'>
        <select id='class' name='class' class='choice'>
            <!--options-->
            <?php
            while($all_class_record=mysqli_fetch_assoc($all_class_result)){
                echo"<option value='".$all_class_record['class_id']."'>";
                echo $all_class_record['classification'];
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
            }
            else {
                echo "
                <table align=center class='content-table'>
                    <tr>
                        <th> Name</th>
                        <th> City</th>
                        <th> Country</th>
                        <th> Classification</th>
                        <th> Job Type</th>
                        <th> Education</th>
                        <th> Title</th>
                        <th> Content</th>
                    </tr>";

                while ($row = mysqli_fetch_array($result)) {
                    /* set name to 'Anonymous' if null */
                    if (empty($row['name'])) {
                        $row['name'] = "Anonymous";
                    }

                    /* iterate and display all info */
                    echo ' <tr> 
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['city'] . '</td>
                    <td>' . $row['country'] . '</td>
                    <td>' . $row['classification'] . '</td>
                    <td>' . $row['type'] . '</td>
                    <td>' . $row['education'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['content'] . '</td>
                    </tr>';
                }
            }
        ?>
        </table>

</main>
</body>
