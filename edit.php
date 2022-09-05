<?php
session_start();

$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

if((!isset($_SESSION['logged_in'])) or $_SESSION['logged_in'] != 1){
    header("Location: error_page.php");
}
?>

<?php
$update_notes = "SELECT * FROM notes";
$update_notes_record = mysqli_query($con, $update_notes);
$note_id = "notes[note_id]";
?>

<!DOCTYPE html>
<html lang=""en">

<head>
    <title> YNOT </title>
    <meta charset=""utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>

</head>

<body>
<header>
    <h1> YNOT </h1>
    <nav>
        <a class='page' href='index.php'> Home</a>
        <a class='page' href='stories.php'> Stories</a>
        <a class='page' href='login.php'> Log in</a>
        <a class='page' href='process_logout.php'> Log Out</a>
    </nav>
</header>

<main>
    <h2> Edit post </h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Content</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($update_notes_record))
        {
            echo "<tr><form action = process_edit.php method = post>";
            echo "<td><input type=text name=Name value='".$row['name']."'></td>";
            echo "<td><input type=text name=Title value='".$row['title']."'></td>";
            echo "<td><input type=text name=Content value='".$row['content']."'></td>";
            echo "<input type=hidden name=noteID value='".$row['note_id']."'>";
            echo "<td><input type=submit></td>";
            echo "<td><a href=process_delete.php?note_id=" .$row['note_id']. ">Delete</a></td>";
            echo "</form></tr>";
        }
        ?>
    </table>
</main>