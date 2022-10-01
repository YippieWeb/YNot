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


/* functions for log in page */

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

    $pwdHashed = trim($uidExists["password"]);

    /* check if password matches username */
    /*$checkPwd = password_verify($pass, $pwdHashed);*/

    if ($pass != $pwdHashed) {
        header("location: login.php?error=wronglogin");
        exit();
    } else if ($pass == $pwdHashed) {
        session_start();
        $_SESSION["user_id"] = $uidExists["user_id"];
        $_SESSION["username"] = $uidExists["username"];
        header("location: index.php");
        exit();
    }
}
