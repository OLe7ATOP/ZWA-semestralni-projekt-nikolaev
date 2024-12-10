<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = htmlspecialchars($_POST["fname"]);
    $secondname = htmlspecialchars($_POST["sname"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $mail = htmlspecialchars($_POST["mail"]);
    if(isset($_POST["imgdel"])){
        $imgdel = htmlspecialchars($_POST["imgdel"]);
    }

    echo $imgdel;



}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: registration.php");
    exit();
}