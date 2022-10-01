<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
include_once 'header.php';
?>

<?php
/*User Query* /
/*SELECT user_id, username FROM users*/
$this_username_query = "SELECT user_id, username FROM users 
                        WHERE user_id = '".$_SESSION["user_id"]."'";
$this_username_result = mysqli_query($con, $this_username_query);

/*Tag Query*/
/*SELECT country_id, country FROM countries*/
$all_tag_query = "SELECT tag_id, tag FROM tags";
$all_tag_result = mysqli_query($con, $all_tag_query);
?>

<main>
    <h2> Add post </h2>
    <div id="container">
        <br>
        <!--- Add post form --->
        <form method='post' action='process_insert.php'>
            <!--- Show username --->
            <label> Username: </label>
            <select id="userid" name="UserId">
                <?php
                while($this_username_record=mysqli_fetch_assoc($this_username_result)){
                    echo"<option value='".$this_username_record['user_id']."'>";
                    echo $this_username_record['username'];
                    echo"</option>";
                }
                ?>
            </select>
            <br>

            <!--- Ask tag (drop-down) --->
            <label> Tag: </label>
            <select id='tag' name='Tag' class='choice'>
                <!--- tag options --->
                <?php
                while($all_tag_record=mysqli_fetch_assoc($all_tag_result)){
                    echo"<option value='".$all_tag_record['tag_id']."'>";
                    echo $all_tag_record['tag'];
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
        <!--- Add post form --->
    </div>
</main>