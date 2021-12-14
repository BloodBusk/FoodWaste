<?php 
$server = "thomasbusk.eu.mysql";
$dBUsername = "logintest";
$dBPassword = "thbthb12";
$dBName = "logintest";

//connect to database
$conn = mysqli_connect($server, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("connection failed: " . mysqli_connect_error());
}