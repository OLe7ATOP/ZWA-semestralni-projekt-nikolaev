<?php
session_start();

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    $mail = $_POST["mail"];
    $password = $_POST["pass"];

    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if(!file_exists($filepath)){

        $_SESSION["message"] = "Server DB access error";
        header("Location: login.php");
        exit();
    }

    $jsonContent = file_get_contents($filepath);
    $existingData = json_decode($jsonContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        exit("JSON file err: " . json_last_error_msg());
    }


    $finduser = false;
    foreach($existingData as $user) {
        if($user["mail"] === $mail){
            if(password_verify($password, $user["pass"])){
                $_SESSION["user"] = json_encode($user, true);
                $_SESSION["status"] = $user["status"];
                header("Location: userpage.php");
                exit();
            } else {
                $_SESSION["message"] = "Wrong password";
                header("Location: login.php");
                exit();
            }
        }
    }
    if(!$finduser){
        $_SESSION["message"] = "User does not exist";
        header("Location: login.php");
        exit();
    }

}
