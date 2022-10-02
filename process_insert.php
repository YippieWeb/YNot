<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
if (isset($_POST["submit"])) {

    $UserId = $_POST['UserId'];
    $Tag = $_POST['Tag'];
    $Title = $_POST['Title'];
    $Content = $_POST['Content'];

    require_once 'functions.php';

    /* catch empty input */
    if (emptyInputInsert($UserId, $Tag, $Title, $Content) !== false) {
        header("location: insert.php?error=emptyinput");
        exit();
    }

    createPost($con, $UserId, $Tag, $Title, $Content);
}
else{
    header("location: insert.php");
    exit();
}

/*
$UserId = $_POST['UserId'];
$Tag = $_POST['Tag'];
$Title = $_POST['Title'];
$Content = $_POST['Content'];

$insert_post = "INSERT INTO posts (user_id, tag_id, title, content)
               VALUES ('$UserId', '$Tag', '$Title', '$Content')";

if (!mysqli_query($con, $insert_post))
{
    echo 'Not Inserted';
}
else
{
    echo 'Inserted';
    header("Refresh:0.5; url=stories.php");
}
?>
*/