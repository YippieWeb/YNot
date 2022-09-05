<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
$Name = $_POST['Name'];
$City = $_POST['City'];
$Country = $_POST['Country'];
$Classification = $_POST['Classification'];
$Type = $_POST['Type'];
$Education = $_POST['Education'];
$Title = $_POST['Title'];
$Content = $_POST['Content'];

$insert_post = "INSERT INTO posts (name, city, country_id, class_id, type_id, edu_id, title, content)
               VALUES ('$Name', '$City', '$Country', '$Classification', '$Type', '$Education', '$Title', '$Content')";

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