<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="StylesSport.css" rel="stylesheet" />
    <title>
        <?php echo $title; ?>
    </title>
</head>
<body>
<h1><a href="mainpage.php" class="mainlink">GYM in Prague</a>
    <div class="personallinks">
    <?php
    if($_SESSION["status"] == "unlogin") {
        echo "<a href='login.php'>Log In</a> | <a href='registration.php'>Register</a>";
    } else {
        $user = json_decode($_SESSION["user"], true);
        echo "<a href='userpage.php'>{$user["fname"]} {$user["sname"]}</a> | <a href='logout.php'>Log Out</a>";
    }
    ?>
    </div>

</h1>
