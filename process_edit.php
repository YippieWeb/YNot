<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
$update_post = "UPDATE posts SET name='$_POST[Name]', title='$_POST[Title]', content='$_POST[Content]' WHERE post_id='$_POST[postID]'";

if (!mysqli_query($con,$update_post))
{
    echo 'Not Updated';
}
else
{
    echo 'Updated';
    header("Refresh:0.5; url=stories.php");
}
?>