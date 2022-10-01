<?php
/*session_start();*/

$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

/*
if((!isset($_SESSION['logged_in'])) or $_SESSION['logged_in'] != 1){
    header("Location: error_page.php");
}
*/
?>

<?php
$update_post = "SELECT * FROM posts";
$update_posts_record = mysqli_query($con, $update_post);
$posts_id = "posts[post_id]";
?>

<?php
include_once 'header.php';
?>

<main>
    <h2> Edit post </h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
        </tr>
        <?php
        if (isset($_SESSION["user_id"])) {
            while ($row = mysqli_fetch_assoc($update_posts_record)) {
                if ($_SESSION["user_id"] == $row['user_id']) {
                    echo "<tr><form action = process_edit.php method = post>";
                    echo "<td><input type=text name=Title value='" . $row['title'] . "'></td>";
                    echo "<td><input type=text name=Content value='" . $row['content'] . "'></td>";
                    echo "<input type=hidden name=postID value='" . $row['post_id'] . "'>";
                    echo "<td><input type=submit></td>";
                    echo "<td><a href=process_delete.php?post_id=" . $row['post_id'] . ">Delete</a></td>";
                    echo "</form></tr>";
                }
            }
        }
        ?>
    </table>
</main>