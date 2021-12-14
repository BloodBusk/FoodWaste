<?php

// error functions that returns true or false for the error handlers
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    $result = true;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($username)
{
    $result = true;
    if (!preg_match('/^[a-zA-Z]*$/', $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result = true;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    //prepared statement to prevent users from writing code in text fields
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd, $type)
{
    //sql query to add profile picture to user
    $sql2 = "INSERT INTO profileimg (userid, statusBool) VALUES ('$username', 1)";
    mysqli_query($conn, $sql2);

    // create user
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersType) VALUES (?, ?, ?, ?, ?);";
    //prepared statement to prevent users from writing code in text fields
    $stmt = mysqli_stmt_init($conn);
    // prepare sql statement with no more than 1 statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // hashed password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    //bind parameter to sql statement
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // redirect to login.php
    header("location: ../login.php?error=none");
    exit();
}

// error function returns true or false
function emptyInputLogin($username, $pwd)
{
    $result = true;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// logs user in checks mysql connection username and password
function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}

// create store
function createStore($conn, $storeName, $storeCVR, $StoreAddress, $userId)
{
    $sql = "INSERT INTO seller (storeName, storeCVR, storeAddress, userId) VALUES (?, ?, ?, ?)";
    mysqli_query($conn, $sql);

    //prepared statement to prevent users from writing code in text fields
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $storeName, $storeCVR, $StoreAddress, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?error=none");
    exit();
}

// create food
function createFood($conn, $foodName, $foodPrice, $foodAmount, $userId)
{
    $sql = "INSERT INTO food (foodName, foodPrice, foodAmount, sellerId) VALUES (?, ?, ?, ?)";
    mysqli_query($conn, $sql);

    //prepared statement to prevent users from writing code in text fields
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $foodName, $foodPrice, $foodAmount, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?error=none");
    exit();
}