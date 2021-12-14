<?php

require "../class/foodDatabase.php";
session_start();



if($_GET['action'] == "search"){
    if(isset($_GET['searchInput'])){
        $searchString = $_GET['searchInput'];

        $foodData = new FoodDatabase();

        $result = $foodData->SearchByName($searchString);

        $foodObjects = [];
        for($i = 0; $i < count($result); $i++){
            $foodObjects[] = $foodData->GetFoodById($result[$i]);
        }

        $_SESSION['foodObjects'] = $foodObjects;
        header('location: ../index.php');
        exit;
    }
}