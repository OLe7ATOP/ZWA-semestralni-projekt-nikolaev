<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $data = $_POST["traininginfo"];

    $requiredUserId = substr($data, 0, strlen($data) - 10);
    $timeToDel = substr($data,  -5);
    $dowToDel = substr($data, -9, 3);

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

    foreach ($existingData as $userid => &$someUser) {
        if ($userid == $requiredUserId) {
            // Проходим по всем тренировкам для данного дня недели
            foreach ($someUser['trainings'][$dowToDel] as $index => $trainToDel) {
                // Если найдено совпадение времени
                if ($trainToDel['start'] == $timeToDel) {
                    // Удаляем элемент с помощью unset()
                    unset($someUser['trainings'][$dowToDel][$index]);
                    $_SESSION['user'] = $someUser;
                    $_SESSION['id'] = $userid;
                    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    header("Location: userpage.php");
                    exit();
                }
            }
        }
    }
    echo "UNKNOWN ERROR!";


}