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

    $age = new DateTime();
    $age = $age->diff(new DateTime($dob))->y;

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
        "age" => $age->y,
        "gender" => $gender,
        "pass" => $passhash,
        "mail" => $mail,
        "status" => "customer"
    ];

    if(isset($_FILES['profilephoto']) && $_FILES['profilephoto']['tmp_name'] !== '') {
        $file = $_FILES['profilephoto'];
        $pictDir = __DIR__.'/pictures/userpictures/';
        if(!is_dir($pictDir)){
            mkdir($pictDir, 0777, true);
        }

        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid('userpic_', true).'.'.$file_extension;
        $picFilePath = $pictDir.$uniqueFileName;

        if(move_uploaded_file($file['tmp_name'], $picFilePath)){
            $data["photo"] = $uniqueFileName;
        } else {
            $_SESSION["message"] = "Error in loading photo";
            $err = true;
            header("Location: registration.php");
            exit();
        }
    }

    if(isset($_POST['aboutme'])){
        $data['aboutme'] = $_POST['aboutme'];
    }

    $filepath = __DIR__ . '\jsondb\userinfo.json';

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

    $data["id"] = sizeof($existingData) * 3 + 13;

    foreach ($existingData as $user){
        if($data["mail"] == $user["mail"]){
            $_SESSION["message"] = "This e-mail is already in use";
            header("Location: registration.php");
            exit();
        }
    }


    $existingData[] = $data;
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $_SESSION["user"] = json_encode($data, true);
    $_SESSION["status"] = $data["status"];
    header("Location: userpage.php");
    exit();


}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: registration.php");
    exit();
}