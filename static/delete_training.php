<!--
Functional file for managing trainings
-->


<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $data = $_POST["traininginfo"];

    //Getting data about the training from the POST request
    $requiredUserId = substr($data, 0, strlen($data) - 10);
    $timeToDel = substr($data,  -5);
    $dowToDel = substr($data, -9, 3);

    //Downloading DB info
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
            echo "JSON decoding Err: " . json_last_error_msg();
            $existingData = [];
        }
    }

    // Finding required training in DB
    foreach ($existingData as $userid => &$someUser) {
        //Finding user
        if ($userid == $requiredUserId) {
            foreach ($someUser['trainings'][$dowToDel] as $index => $trainToDel) {

                // Finding training
                if ($trainToDel['start'] == $timeToDel) {

                    // Deleting element
                    unset($someUser['trainings'][$dowToDel][$index]);
                    $_SESSION['user'] = $someUser;
                    $_SESSION['id'] = $userid;

                    //Saving data
                    file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    header("Location: userpage.php");
                    exit();
                }
            }
        }
    }
    echo "UNKNOWN ERROR!";


}