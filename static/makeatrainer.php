<?php
session_start();

if(!isset($_POST['action'])) {
    echo "Error while transfering";
} else {

        $action = $_POST['action'];
        if(!isset($_POST['usertochangeid'])) {
            echo "Error in reading user";
        } else{
        $userid = $_POST['usertochangeid'];

        $filepath = __DIR__ . '\jsondb\userinfo.json';

        if (!file_exists($filepath)) {

            $_SESSION["message"] = "Server DB access error";
            header("Location: login.php");
            exit();
        }

        $jsonContent = file_get_contents($filepath);
        $existingData = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            exit("JSON file err: " . json_last_error_msg());
        }
        $userfound = false;
            if($action == "delete"){
                $existingData = array_filter($existingData, function($user) use ($userid, &$userfound) {
                    if($user['id'] == $userid) {
                        $userfound = true;
                        return false;
                    }
                    return true;
                });
            }
            else {
                foreach ($existingData as &$user) {
                    if ($user['id'] == $userid) {
                        if ($action == "makeatrainer") {
                            $user['status'] = 'trainer';
                        }
                        if ($action == "makeanadmin") {
                            $user['status'] = 'admin';
                        }
                        if ($action == "makeacustomer") {
                            $user['status'] = 'customer';
                        }
                        if ($action == "resetpass") {
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $randomString = substr(str_shuffle($characters), 0, 8);
                            $user['pass'] = password_hash($randomString, PASSWORD_DEFAULT);
                            $_SESSION['message'] = "New password for {$user['mail']}: ".$randomString;
                        }
                        if($action == 'edit') {
                            $_SESSION['usertochange'] = $user;
                            header("Location: editpage.php");
                            exit();
                        }
                        $userfound = true;
                        break;
                    }
                }
            }

        if(!$userfound) {
            echo "User is not found";
        }
        file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: admin.php#user_".$userid);
        exit();
        }

}
