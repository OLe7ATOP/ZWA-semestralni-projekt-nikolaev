<?php
session_start();

/*
 * Functional page for editing user info
 * THe name is "makeatrainer.php", because it
 * was the first function of this file.
 * It is used to decide, which operation need
 * to be executed.
 */

if(!isset($_POST['action'])) {
    echo "Error while transfering";
} else {

        $action = $_POST['action'];
        if(!isset($_POST['usertochangeid'])) {
            echo "Error in reading user";
        } else{
        $userid = $_POST['usertochangeid'];

        // Downloading DB
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
                //Deleting user
                $existingData = array_filter($existingData, function($user, $requiredId) use ($userid, &$userfound) {
                    if($requiredId == $userid) {
                        $userfound = true;
                        return false;
                    }
                    return true;
                }, ARRAY_FILTER_USE_BOTH);
            }
            else {
                foreach ($existingData as $requiredId => &$user) {
                    if ($requiredId == $userid) {
                        if ($action == "makeatrainer") {
                            //Changing user's status to 'trainer'
                            $user['status'] = 'trainer';
                            // Default adding specialization
                            $user['spec'] = 'gym';
                        }
                        if ($action == "makeanadmin") {
                            //Changing user's status to 'admin'
                            $user['status'] = 'admin';
                        }
                        if ($action == "makeacustomer") {
                            //Changing user's status to 'customer'
                            $user['status'] = 'customer';
                        }
                        if ($action == "resetpass") {
                            //Generating new pass for the user
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $randomString = substr(str_shuffle($characters), 0, 8);
                            $user['pass'] = password_hash($randomString, PASSWORD_DEFAULT);
                            $_SESSION['message'] = "New password for {$user['mail']}: ".$randomString;
                        }
                        if($action == 'edit') {
                            //Editing user's info
                            $_SESSION['usertochange'] = $user;
                            $_SESSION['usertochangeID'] = $userid;
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
