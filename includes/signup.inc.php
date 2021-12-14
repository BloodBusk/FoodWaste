<?php

// if submit is set, post method
if(isset($_POST["submit"])){
    
    // variables to get form info
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $type = $_POST["usertype"];

    // link database and function php
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    // error messages
    if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== false){
        header("location: ../signup.php?error=invalidUid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username, $email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    
    // create user
    createUser($conn, $name, $email, $username, $pwd, $type);

}else{
    header("location: ../signup.php");
    exit();
}