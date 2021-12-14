<?php 
$server = "localhost";
$dBUsername = "root";
$dBPassword = "thbthb12";
$dBName = "logintest";

//connect to database
$conn = mysqli_connect($server, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("connection failed: " . mysqli_connect_error());
}