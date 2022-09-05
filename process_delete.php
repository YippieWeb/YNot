<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
$delete_drink = "DELETE FROM notes WHERE note_id='$_GET[note_id]'";

if (!mysqli_query($con,$delete_drink))
{
    echo 'Not Deleted';
}
else
{
    echo 'Deleted';
    header("Refresh:0.5; url=stories.php");
}
?>


