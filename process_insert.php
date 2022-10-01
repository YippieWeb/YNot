<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
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