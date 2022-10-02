<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
if (isset($_POST["submit"])) {
    $PostID = $_POST['PostID'];
    $Title = $_POST['Title'];
    $Content = $_POST['Content'];

    require_once 'functions.php';

    /* catch empty input */
    if (emptyInputUpdate($Title, $Content) !== false) {
        header("location: edit.php?error=emptyinput");
        exit();
    }

    updatePost($con, $PostID, $Title, $Content);
}
else{
    header("location: edit.php");
    exit();
}

$update_post = "UPDATE posts SET title='$_POST[Title]', content='$_POST[Content]' WHERE post_id='$_POST[PostID]'";

if (!mysqli_query($con,$update_post))
{
    echo 'Not Updated';
}
else
{
    header("location: edit.php");
}
?>