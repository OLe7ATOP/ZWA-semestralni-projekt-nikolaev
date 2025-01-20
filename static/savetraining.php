<?php
session_start();
$userfromsession = $_SESSION['user'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $start = htmlspecialchars($_POST["time1"]);
    $end = htmlspecialchars($_POST["time2"]);
    $dow = htmlspecialchars($_POST["dow"]);


    if(empty($start)){
        $_SESSION["message"] = "Enter start of the training";
        $err = true;
        header("Location: createtraining.php");
        exit();
    }
    if(empty($end)){
        $_SESSION["message"] = "Enter end of the training";
        $err = true;
        header("Location: createtraining.php");
        exit();
    }
    if(empty($dow)){
        $_SESSION["message"] = "Enter Day of the training";
        $err = true;
        header("Location: createtraining.php");
        exit();
    }

    $data = [
        "start" => $start,
        "end" => $end,
        "dow" => $dow,
    ];


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

            $_SESSION["message"] = "Ошибка декодирования JSON: " . json_last_error_msg();
            $err = true;
            header("Location: userpage.php");
            exit();
        }
    }

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

    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: userpage.php");
    exit();


}   else {
    $_SESSION["message"] = "UNKNOWN ERROR";
    header("Location: userpage.php");
    exit();
}