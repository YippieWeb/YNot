<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
$update_note = "UPDATE notes SET name='$_POST[Name]', title='$_POST[Title]', content='$_POST[Content]' WHERE note_id='$_POST[noteID]'";

if (!mysqli_query($con,$update_note))
{
    echo 'Not Updated';
}
else
{
    echo 'Updated';
    header("Refresh:0.5; url=stories.php");
}
?>