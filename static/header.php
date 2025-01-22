<?php
session_start();
?>

<!--
Header File
-->

<!DOCTYPE html>
<html>
<head>
    <link href="StylesSport.css" rel="stylesheet" />
    <title>
        GYM in Prague
    </title>
    <script src="scripts.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1><a href="mainpage.php" class="mainlink">GYM in Prague</a>
    <div class="personallinks">
    <?php
    // If the user is not logged in. The Buttons "Log In", "Register" will be shown
    if(!isset($_SESSION["status"]) || $_SESSION["status"] == "unlogin") {
        echo "<a href='login.php'>Log In</a> | <a href='registration.php'>Register</a>";
    } else {
        //The functional buttons. Such as Page of the user and "Log Out" will be shown
        $user = $_SESSION["user"];
        if($_SESSION["status"] == "admin") {
            // Administrator has "List of Customers" button
            echo "<a href='admin.php'>List of customers</a> |<a href='userpage.php'> ADMIN </a>| <a href='logout.php'>Log Out</a>";
        } else {
            echo "<a href='userpage.php'>{$user["fname"]} {$user["sname"]}</a> | <a href='logout.php'>Log Out</a>";
        }
    }
    ?>
    </div>


</h1>
