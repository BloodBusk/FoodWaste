<?php

require "../class/foodDatabase.php";
session_start();

// checks if search form is clicked, checks if form is set submit
if($_GET['action'] == "search"){
    if(isset($_GET['searchInput'])){
        // search form variable used to search through database
        $searchString = $_GET['searchInput'];

        // fooddatabase class object
        $foodData = new FoodDatabase();

        $result = $foodData->SearchByName($searchString);

        // array to store searched food and display
        $foodObjects = [];
        for($i = 0; $i < count($result); $i++){
            $foodObjects[] = $foodData->GetFoodById($result[$i]);
        }

        // store array in session
        $_SESSION['foodObjects'] = $foodObjects;
        header('location: ../index.php');
        exit;
    }
}