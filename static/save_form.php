<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = htmlspecialchars($_POST["fname"]);
    $secondname = htmlspecialchars($_POST["sname"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $err = false;

    $_SESSION["display"] = 'block';
    if(empty($firstname)){
        $_SESSION["message"] = "Enter your firstname";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if(empty($secondname)){
        $_SESSION["message"] = "Enter your second name";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if(empty($dob)){
        $_SESSION["message"] = "Enter your Date of birth";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if(empty($gender)){
        $_SESSION["message"] = "Enter your gender";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if(empty($mail)){
        $_SESSION["message"] = "Enter your mail";
        $err = true;
        header("Location: registration.php");
        exit();
    }

    $pass =htmlspecialchars($_POST["pass01"]);
    $pass_check =htmlspecialchars($_POST["pass02"]);

    if(empty($pass)){
        $_SESSION["message"] = "Enter your password";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if(empty($pass_check)){
        $_SESSION["message"] = "Enter your password once more";
        $err = true;
        header("Location: registration.php");
        exit();
    }
    if($pass != $pass_check){
        $_SESSION["message"] = "Location: registration.php";
        $err = true;
        header("Location: registration.php");
        exit();
    }


    $passhash = password_hash($pass, PASSWORD_DEFAULT);

    $currentdate = new DateTime();
    $dobDate = new DateTime($dob);
    $age = $currentdate->diff($dobDate);

    $data = [
        "id" => 0,
        "fname" => $firstname,
        "sname" => $secondname,
        "dob" => $dob,
        "gender" => $gender,
        "pass" => $passhash,
        "mail" => $mail,
        "status" => "customer"
    ];

    $filepath = __DIR__ . '\userinfo\userinfo.json';

    if (file_exists($filepath)) {
        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if ($jsonContent === false) {
            $_SESSION["message"] = "DB access error";
            $err = true;
            header("Location: registration.php");
            exit();
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Ошибка декодирования JSON: " . json_last_error_msg();
            $existingData = [];
        }
    } else {
        $existingData = [];
    }

    foreach ($existingData as $user){
        if($data["mail"] == $user["mail"]){
            $_SESSION["message"] = "This e-mail is already in use";
            header("Location: registration.php");
            exit();
        }
    }

    $data["id"] = sizeof($existingData);
    $existingData[] = $data;
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $_SESSION["message"] = "Info was saved";
    header("Location: registration.php");
    exit();


}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: registration.php");
    exit();
}