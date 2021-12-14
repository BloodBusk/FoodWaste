<?php
session_start();

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