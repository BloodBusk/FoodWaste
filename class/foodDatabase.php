<?php

require "food.php";

class FoodDatabase
{
    private $server = "thomasbusk.eu.mysql"; //localhost - thomasbusk.eu.mysql
    private $username = "logintest"; //root - logintest
    private $password = "thbthb12";
    private $database = "logintest";

    private $mySQL;

    // creates a new link to database everytime class object is instantiated
    function __construct()
    {
        $this->mySQL = new mysqli($this->server, $this->username, $this->password, $this->database);
    }

    public function insertJsonFileIntoDatabase()
    {
        $filename = "json/FoodDatabase.json";
        $data = file_get_contents($filename);
        // var_dump($data);
        $array = json_decode($data, true);
        foreach ($array as $row) {
            $sql = "INSERT INTO food (foodName, foodPrice, foodAmount, sellerId) VALUES ('" . $row['foodName'] . "', '" . $row['foodPrice'] . "', '" . $row['foodAmount'] . "', '" . $row['sellerId'] . "')";
            mysqli_query($this->mySQL, $sql) or die($this->mySQL->error);
        }
    }

    // search product by name, but results from sql query into array allResults and return array
    public function SearchByName($searchInput)
    {
        $allResults = [];

        $sql = "SELECT id FROM product WHERE foodName LIKE ('%$searchInput%')";

        $result = $this->mySQL->query($sql) or die($this->mySQL->error);
        while ($row = $result->fetch_assoc()) {
            $allResults[] = $row['id'];
        }

        return $allResults;
    }

    // fetch food object where id = parameters id from database
    public function GetFoodById($foodId)
    {
        $sql = "SELECT * FROM product WHERE id = '$foodId' LIMIT 1";
        $result = $this->mySQL->query($sql);
        return $result->fetch_object("Food");
    }
}
