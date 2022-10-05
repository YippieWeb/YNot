<?php

function emptyInputSignUp($FName, $LName, $Gender, $Edu, $City, $Username, $Password, $RepeatPassword) {
    $result = true;
    if (empty($FName) || empty ($LName) || empty($Username) || empty($Password) || empty($RepeatPassword)){
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}


// check if any input on sign up page exceeds limit
function exceedLimit($FName, $LName, $Username, $Password) {
    if (strlen($FName) > 30){
        $result = 'longfname';
    } else if (strlen($LName) > 30){
        $result = 'longlname';
    } else if (strlen($Username) > 64){
        $result = 'longusername';
    } else if (strlen($Password) > 128){
        $result = 'longpassword';
    } else {
        $result = 'allpass';
    }

    return $result;
}

function invalidName($FName, $LName) {
    $result = true;
    if (!preg_match("/^[a-zA-Z]*$/", $FName) OR !preg_match("/^[a-zA-Z]*$/", $LName)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidUid($Username) {
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $Username)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function uidExists($con, $Username) {
    $result = true;
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($con); /* initialise prepare statement */

    /* catch backend/sql error */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    /* bind user data input to statement and execute */
    mysqli_stmt_bind_param($stmt, "s", $Username);
    mysqli_stmt_execute($stmt);

    /* get result from statement */
    $resultData = mysqli_stmt_get_result($stmt);

    /* iterate database and check duplication */
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function badPassword($Password) {
    $result = true;

    // Validate password strength
    // adpated from https://www.codexworld.com/how-to/validate-password-strength-in-php/
    $uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    $specialChars = preg_match('@[^\w]@', $Password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 8) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function pwdMatch($Password, $RepeatPassword) {
    $result = true;
    if ($Password !== $RepeatPassword) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}


function createUser($con, $FName, $LName, $Gender, $Edu, $City, $Username, $Password) {
    $sql = "INSERT INTO users (fname, lname, gender_id, edu_id, city_id, username, password)
               VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($con); /* initialise prepare statement */

    /* catch backend/sql error */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($Password, PASSWORD_DEFAULT);

    /* bind user data input to statement and execute */
    mysqli_stmt_bind_param($stmt, "sssssss", $FName, $LName, $Gender, $Edu, $City, $Username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* redirect user to sign up page, states no error */
    header("location: signup.php?error=none");
    exit();
}
/* functions for sign up page end */


/* functions for log in page start */

function emptyInputLogIn($user, $pass)
{
    $result = true;
    if (empty($user) || empty ($pass)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginUser($con, $user, $pass)
{
    $uidExists = uidExists($con, $user);

    if ($uidExists == false) {
        header("location: login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["password"];
    $checkPwd = password_verify($pass, $pwdHashed);

    /* check if password matches username */
    /*$checkPwd = password_verify($pass, $pwdHashed);*/

    if ($checkPwd == false) {
        header("location: login.php?error=wronglogin");
        exit();
    } else if ($checkPwd == true) {
        session_start();
        $_SESSION["user_id"] = $uidExists["user_id"];
        $_SESSION["username"] = $uidExists["username"];
        header("location: index.php");
        exit();
    }
}

/* functions for log in page end */

/* functions for insert page start */
function emptyInputInsert($UserId, $Tag, $Title, $Content)
{
    $result = true;
    if (empty($Title) || empty ($Content)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function exceedLimitInsert($Title, $Content) {
    if (strlen($Title) > 100){
        $result = 'longtitle';
    } else if (strlen($Content) > 2000){
        $result = 'longcontent';
    } else {
        $result = 'allpass';
    }
    return $result;
}

function createPost($con, $UserId, $Tag, $Title, $Content, $Date) {
    $sql = "INSERT INTO posts (user_id, tag_id, title, content, post_date)
               VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($con); /* initialise prepare statement */

    /* catch backend/sql error */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: insert.php?error=stmtfailed");
        exit();
    }

    /* bind post data input to statement and execute */
    mysqli_stmt_bind_param($stmt, "sssss", $UserId, $Tag, $Title, $Content, $Date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* redirect user to insert page, states no error */
    header("location: insert.php?error=none");
    exit();
}
/* functions for insert page end */

/* functions for edit page start */
function emptyInputUpdate($Title, $Content)
{
    $result = true;
    if (empty($Title) || empty ($Content)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function updatePost($con, $PostID, $Title, $Content) {
    $sql = "UPDATE posts SET title= ?, content= ? WHERE post_id= ? ";

    $stmt = mysqli_stmt_init($con); /* initialise prepare statement */

    /* catch backend/sql error */
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: edit.php?error=stmtfailed");
        exit();
    }

    /* bind post data input to statement and execute */
    mysqli_stmt_bind_param($stmt, "sss",  $Title, $Content, $PostID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* redirect user to insert page, states no error */
    header("location: edit.php?error=none");
    exit();
}