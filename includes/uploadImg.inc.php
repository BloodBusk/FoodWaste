<?php

session_start();
include_once "dbh.inc.php";

$useruid = $_SESSION["useruid"];

if(isset($_POST["submit"])){
    $file = $_FILES["file"];

    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];
    $fileType = $file["type"];
    $uploadDir = "../img/uploads/";

    // explode seperates the file name string at "."
    $fileExt = explode(".", $fileName);
    // makes string lower case
    $fileActualExt = strtolower(end($fileExt));
    
    // array to store allowed file types
    $allowed = ["jpg", "jpeg", "png"];

    if(in_array($fileActualExt, $allowed)){
        //boolean file error 0 = false (there was no error)
        if($fileError === 0){
            //file size less that 100000 kb
            if($fileSize < 1000000){
                $fileNameNew = "profile".$useruid.".".$fileActualExt;
                $fileDestination = $uploadDir.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE profileimg SET statusBool=0 WHERE userid='$useruid';";
                $result = mysqli_query($conn, $sql);
                header("location: ../profile.php?upload=success");
            }else{
                echo "File type is too big";
            }
        }else{
            echo "There was an error uploading you file";
        }
    }else{
        echo "You cannot upload this type of file";
    }

}