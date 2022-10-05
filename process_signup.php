<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/* ensure user submit the correct details before allowing login */
if (isset($_POST["submit"])) {

    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Gender = $_POST['Gender'];
    $Edu = $_POST['Edu'];
    $City = $_POST['City'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $RepeatPassword = $_POST['RepeatPassword'];

    require_once 'functions.php'; /* functions page */

    /* catch empty input */
    if(emptyInputSignUp($FName, $LName, $Gender, $Edu, $City, $Username, $Password, $RepeatPassword) !== false) {
        header("location: signup.php?error=emptyinput");
        exit();
    }

    $Exceed = exceedLimitInsert($FName, $LName, $Username, $Password);
    if($Exceed !== 'allpass') {
        header("location: signup.php?error=$Exceed");
        exit();
    }

    // catch invalid name (i.e. contain special characters)
    if(invalidName($FName, $LName) !== false) {
        header("location: signup.php?error=invalidname");
        exit();
    }

    // catch invalid username (i.e. contain special characters)
    if(invalidUid($Username) !== false) {
        header("location: signup.php?error=invaliduid");
        exit();
    }

    // catch duplicated username
    if(uidExists($con, $Username) !== false) {
        header("location: signup.php?error=usernametaken");
        exit();
    }

    // catch bad password
    if(badPassword($Password) !== false) {
        header("location: signup.php?error=badpassword");
        exit();
    }

    // catch mismatching password
    if(pwdMatch($Password, $RepeatPassword) !== false) {
        header("location: signup.php?error=passwordsdontmatch");
        exit();
    }

    // create user in database successfully
    createUser($con, $FName, $LName, $Gender, $Edu, $City, $Username, $Password);

}
else {
    header("Refresh:0.5; url=signup.php");
    exit();
}