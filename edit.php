<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
include_once 'header.php';
?>

<?php
if (isset($_SESSION["user_id"])) {
    $update_post = "SELECT * FROM posts 
                    WHERE user_id = '" . $_SESSION["user_id"] . "'";
    $update_posts_record = mysqli_query($con, $update_post);
    $posts_id = "posts[post_id]";
}
?>

<main>
    <h2> Edit post </h2>
        <?php
        if (isset($_SESSION["user_id"])) {
            $count = mysqli_num_rows($update_posts_record);
            if($count==0) /*no posts*/{
                echo "<p>You have no post yet.</p>";
            }
            else {
                while ($row = mysqli_fetch_assoc($update_posts_record)) {

                    echo "<form action = process_edit.php method = post>";
                    echo "<p>Title</p>";
                    echo "<input type=text name=Title value='" . $row['title'] . "'><br>";

                    echo "<p>Content</p>";
                    echo "<textarea type=text name=Content>" . $row['content'] . "</textarea><br>";
                    echo "<input type=hidden name=PostID value='" . $row['post_id'] . "'>";
                    echo "<div class='edit-btn'><input class=\"btn-1 var-2\" type=submit name=submit id=submit>
                          <div class='delete-btn'>
                          <button class=\"delete-btn\" onclick=\"deleteAlert()\">
                               <a href=process_delete.php?post_id=" . $row['post_id'] . ">Delete</a>
                          </button>
                          </div></div>";
                    echo "</form>";
                }
            }
        } else {
            echo "<p>Please log in first.</p>";
        }
        ?>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h4> Don't leave it blank! </h4>";
        }
        else if ($_GET["error"] == "none") {
            echo "<h4> Updated! </h4>";
        }
    }
    ?>
</main>

<script>
    function deleteAlert() {
        alert("Are you sure you want to delete this post?");
    }
</script>