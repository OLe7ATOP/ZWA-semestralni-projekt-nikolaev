<?php
session_start();
header('Content-Type: application/json');

/*
 * Functional file for saving the
 * new user's info to DB
 */

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Getting the data
    $firstname = htmlspecialchars($_POST["fname"]);
    $secondname = htmlspecialchars($_POST["sname"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $pass = htmlspecialchars($_POST["pass01"]);
    $pass_check = htmlspecialchars($_POST["pass02"]);
    $err = false;

    // Валидация на сервере
    if (empty($firstname) || empty($secondname) || empty($dob) || empty($mail) || empty($pass) || empty($pass_check)) {
        echo json_encode(["status" => "error", "message" => "Feel all the fields are required."]);
        exit();
    }

    if ($pass !== $pass_check) {
        echo json_encode(["status" => "error", "message" => "Пароли не совпадают!"]);
        exit();
    }
    $age = new DateTime();
    $age = $age->diff(new DateTime($dob))->y;


    $passhash = password_hash($pass, PASSWORD_DEFAULT);

    $currentdate = new DateTime();
    $dobDate = new DateTime($dob);
    $age = $currentdate->diff($dobDate);



    /*
     * Converting the data to the
     *  required form.
     */


    $data = [
        "fname" => $firstname,
        "sname" => $secondname,
        "dob" => $dob,
        "age" => $age->y,
        "gender" => $gender,
        "pass" => $passhash,
        "mail" => $mail,
        "status" => "customer",
        "trainings" => [
            'mon' => [],
            'tue' => [],
            'wed' => [],
            'thu' => [],
            'fri' => [],
            'sat' => [],
            'sun' => []
        ]
    ];

    //loading the photo
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
            echo json_encode(["status" => "error", "message" => "Error in loading photo"]);
            exit();

        }
    }

    if(isset($_POST['aboutme'])){
        $data['aboutme'] = $_POST['aboutme'];
    }

    //Download DB
    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if (file_exists($filepath)) {
        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if ($jsonContent === false) {
            $_SESSION["message"] = "DB access error";
            $err = true;
            echo json_encode(["status" => "error", "message" => "DB access error"]);
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
        //Checking if the e-mail is free to use
        if($data["mail"] == $user["mail"]){
            echo json_encode(["status" => "error", "message" => "This e-mail is already in use"]);
            exit();
        }
    }
    //Adding the ID to the user
    $id = sizeof($existingData) * 13 + 13;

    //Saving the data
    $existingData[$id] = $data;
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $_SESSION["user"] = $data;
    $_SESSION["status"] = $data["status"];
    $_SESSION['id'] = $id;

    echo json_encode(['status' => 'success', 'redirect' => 'userpage.php']);
    exit();


}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: registration.php");
    exit();
}