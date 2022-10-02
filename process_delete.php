<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
$delete_post = "DELETE FROM posts WHERE post_id='$_GET[post_id]'";

if (!mysqli_query($con,$delete_post))
{
    echo 'Not Deleted';
}
else
{
    header("location: edit.php");
}
?>


