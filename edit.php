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
    <div class="edit-form">
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h4> Don't leave it blank! </h4>";
        } else if ($_GET["error"] == "longtitle") {
            echo "<h4> Title can't exceed 100 characters. </h4>";
        } else if ($_GET["error"] == "longcontent") {
            echo "<h4> Content can't exceed 2000 characters. </h4>";
        } else if ($_GET["error"] == "none") {
            echo "<h4> Updated! </h4>";
        }
    }
    ?>

        <?php
        if (isset($_SESSION["user_id"])) {
            $count = mysqli_num_rows($update_posts_record);
            if($count==0) /*no posts*/{
                echo "<p>You have no post yet.</p>";
            }
            else {
                echo "<div class=\"post-container edit\">";
                while ($row = mysqli_fetch_assoc($update_posts_record)) {
                    echo "<div class=\"post edit\">";

                    echo "<form action = process_edit.php method = post>";

                    // editable post title
                    echo "<p>Title:</p>";
                    echo "<input class=title type=text name=Title value='" . $row['title'] . "'><br>";

                    // editable post content
                    echo "<p>Content:</p>";
                    echo "<textarea class=content type=text name=Content>" . $row['content'] . "</textarea><br>";

                    // getting the post's id
                    echo "<input type=hidden name=PostID value='" . $row['post_id'] . "'>";

                    // sumbit and delete button
                    echo "<div class='edit-btns'>
                          <input class=\"submit-btn\" type=submit name=submit id=submit>
                          <div class='delete-div'>
                          <button class=\"delete-btn\" onclick=\"return checkdelete()\">
                               <a href=process_delete.php?post_id=" . $row['post_id'] . ">Delete</a>
                          </button>
                          </div></div>";
                    echo "</form>";

                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>Please log in first.</p>";
        }
        ?>
    </div>
</main>

<script>
    function checkdelete() {
        return confirm('Permanently delete this post?');
    }
</script>