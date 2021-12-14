<?php
session_start();

// checks if form is set submit, takes data from form and adds to createStore function
if(isset($_POST["submit"])){
    
    $storeName = $_POST["storeName"];
    $cvr = $_POST["cvr"];
    $address = $_POST["storeAddress"];
    $id = $_SESSION["useruid"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    
    createStore($conn, $storeName, $cvr, $address, $id);

}else{
    header("location: ../signup.php");
    exit();
}