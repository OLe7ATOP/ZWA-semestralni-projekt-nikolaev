<?php
session_start();
header('Content-Type: application/json');

/*
 * File for adding the training to
 * the user's schedule
 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    /*
     * Getting the data in the string form
     * and separating it on the required parts.
     */
    $data = $_POST["traininginfo"];

    $trainerID = substr($data, 0, strlen($data) - 10);
    $timeTo = substr($data,  -5);
    $dowTo = substr($data, -9, 3);

    //Download DB
    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if (file_exists($filepath)) {
        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if ($jsonContent === false) {
            echo json_encode(["status" => "error", "message" => "DB access error"]);
            exit();
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Ошибка декодирования JSON: " . json_last_error_msg();
            $existingData = [];
        }
    }

    $customerid = $_SESSION["id"];


    //Getting the required training out of DB
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

    //Adding training to the user's schedule
    foreach ($existingData as $userid => &$someUser) {
        if ($userid == $customerid) {
            if(isset($training)) {
                foreach($someUser['trainings'][$dowTo] as &$session){
                    if($session['start'] <= $training['start'] && $session['end'] >= $training['start'] || $session['start'] <= $training['end'] && $session['end'] >= $training['end']){
                        echo json_encode(["status" => "error", "message" => "Oops... Looks like you have another training in this time"]);
                        exit();
                    }
                }
                $someUser['trainings'][$dowTo][] = $training;
                usort($someUser['trainings'][$dowTo], function ($a, $b) {
                    return $a['start'] <=> $b['start'];
                });
                $_SESSION['user'] = $someUser;
                $_SESSION['id'] = $userid;
                file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

                echo json_encode(["status" => "success", "redirect" => "userpage.php"]);
                exit();

            } else {
                echo json_encode(["status" => "error", "message" => "Oops... Some Error"]);
                exit();
            }
        }
    }
    echo json_encode(["status" => "error", "message" => "Unknown error"]);
    exit();


}