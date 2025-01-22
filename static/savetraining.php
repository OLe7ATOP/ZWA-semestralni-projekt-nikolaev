<?php
session_start();
header('Content-Type: application/json');
$userfromsession = $_SESSION['user'];

/*
 * File for saving new training
 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Getting the data from the POST request
    $start = htmlspecialchars($_POST["time1"]);
    $end = htmlspecialchars($_POST["time2"]);
    $dow = htmlspecialchars($_POST["dow"]);


    if(empty($start) || empty($end) || empty($dow)){
        echo json_encode(["status" => "error", "message" => "Feel all the fields are required."]);
        exit();
    }


    //Converting the data to the required form
    $data = [
        "start" => $start,
        "end" => $end,
        "dow" => $dow,
    ];


    //Download DB
    $filepath = __DIR__ . '\jsondb\userinfo.json';

    if (file_exists($filepath)) {
        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if ($jsonContent === false) {
            $_SESSION["message"] = "DB access error";
            $err = true;
            header("Location: userpage.php");
            exit();
        }

        if (json_last_error() !== JSON_ERROR_NONE) {

            echo json_encode(["status" => "error", "message" => "JSON decoding err"]);
            exit();
        }
    }

    //Getting required user and saving the new training to his list
    foreach($existingData as $userid => &$userinfo){
        if ($userid == $_SESSION['id']) {
            if (!isset($userinfo['trainings'])) {
                $userinfo['trainings'] = [
                    'mon' => [],
                    'tue' => [],
                    'wed' => [],
                    'thu' => [],
                    'fri' => [],
                    'sat' => [],
                    'sun' => []
                ];
            }
            $userinfo['trainings'][$data['dow']][] = $data;

            usort($userinfo['trainings'][$data['dow']], function ($a, $b) {
                return $a['start'] <=> $b['start'];
            });
            $_SESSION['user'] = $existingData[$userid];
            $_SESSION['id'] = $userid;
            break;
        }

    }

    //Saving the data
    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["status" => "success", "redirect" => "userpage.php"]);
    exit();

}   else {
    echo json_encode(["status" => "error", "message" => "Unknown error"]);
    exit();
}