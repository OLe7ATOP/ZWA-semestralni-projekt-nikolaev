<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $data = $_POST["traininginfo"];

    $trainerID = substr($data, 0, strlen($data) - 10);
    $timeTo = substr($data,  -5);
    $dowTo = substr($data, -9, 3);

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
    }

    $customerid = $_SESSION["id"];


    foreach ($existingData as $userid => &$someUser) {
        if ($userid == $trainerID) {
            foreach ($someUser['trainings'][$dowTo] as $index => $requiredTraining) {
                if ($requiredTraining['start'] == $timeTo) {
                    $training = $requiredTraining;
                    $training['trainer']['fname'] = $someUser['fname'];
                    $training['trainer']['sname'] = $someUser['sname'];
                }
            }
        }
    }
    foreach ($existingData as $userid => &$someUser) {
        if ($userid == $customerid) {
            if(isset($training)) {
                $someUser['trainings'][$dowTo][] = $training;
                $_SESSION['user'] = $someUser;
                $_SESSION['id'] = $userid;
                file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                header("Location: userpage.php");
                exit();
            } else {
                header("Location: userpage.php");
                exit();
            }
        }
    }

    echo "UNKNOWN ERROR!";


}