<?php

/*
 * Functional page for saving changed user to DB
 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Getting the entered data
    $firstname = htmlspecialchars($_POST["fname"]);
    $secondname = htmlspecialchars($_POST["sname"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $aboutme = htmlspecialchars($_POST["aboutme"]);
    $usertoeditID = htmlspecialchars($_POST["usertochangeid"]);
    $spec = htmlspecialchars($_POST["spec"]);


    //Download DB
    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if (file_exists($filepath)) {
        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if ($jsonContent === false) {
            $_SESSION["message"] = "DB access error";
            $err = true;
            header("Location: mainpage.php");
            exit();
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Ошибка декодирования JSON: " . json_last_error_msg();
            header("Location: mainpage.php");
        }
    }

    //Adding info to the list of users
    foreach ($existingData as $userDBID => &$userDBInfo) {
        if($userDBID == $usertoeditID){
            $userDBInfo['fname'] = $firstname;
            $userDBInfo['sname'] = $secondname;
            $userDBInfo['dob'] = $dob;
            $userDBInfo['gender'] = $gender;
            $userDBInfo['mail'] = $mail;
            $userDBInfo['aboutme'] = $aboutme;
            if($userDBInfo['status'] == 'trainer'){
                $userDBInfo['spec'] = $spec;
            }
            break;
        }
    }

    //Saving the data
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: admin.php");
    exit();

}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: registration.php");
    exit();
}