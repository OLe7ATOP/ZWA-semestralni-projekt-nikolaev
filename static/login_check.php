<?php
session_start();
header('Content-Type: application/json');

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    // Getting data through the POST request
    $mail = $_POST["mail"];
    $password = $_POST["pass"];

    if (empty($mail) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Feel all the fields are required."]);
        exit();
    }

    // Downloading DB
    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if(!file_exists($filepath)){
        echo json_encode(["status" => "error", "message" => "DB access error"]);
        exit();
    }

    $jsonContent = file_get_contents($filepath);
    $existingData = json_decode($jsonContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        exit("JSON file err: " . json_last_error_msg());
    }


    $finduser = false;
    foreach($existingData as $userid => $user) {
        //Checking for the required mail in the system
        if($user["mail"] === $mail){

            // Verification of the password
            if(password_verify($password, $user["pass"])){
                $_SESSION["user"] = $user;
                $_SESSION["status"] = $user["status"];
                $_SESSION['id'] = $userid;
                echo json_encode(["status" => "success", "redirect" => "userpage.php"]);
                exit();
            } else {
                echo json_encode(["status" => "error", "message" => "Wrong password"]);
                exit();
            }
        }
    }
    if(!$finduser){
        echo json_encode(["status" => "error", "message" => "User does not exist"]);
        exit();
    }

}
