<?php
session_start();

// checks if form is set submit, takes data from form and adds to createFood function
if(isset($_POST["submit"])){
    
    $foodName = $_POST["foodName"];
    $foodPrice = $_POST["foodPrice"];
    $foodAmount = $_POST["foodAmount"];
    $id = $_SESSION["useruid"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    
    createFood($conn, $foodName, $foodPrice, $foodAmount, $id);

}else{
    header("location: ../signup.php");
    exit();
}