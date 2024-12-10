<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="StylesSport.css" rel="stylesheet" />
    <title>
        <?php echo $_SESSION['status'] ?>
    </title>
</head>
<body>
<h1><a href="mainpage.php" class="mainlink">GYM in Prague</a>
    <div class="personallinks">
    <?php
    if(!isset($_SESSION["status"]) || $_SESSION["status"] == "unlogin") {
        echo "<a href='login.php'>Log In</a> | <a href='registration.php'>Register</a>";
    } else {
        if($_SESSION["status"] == "admin") {
            $user = json_decode($_SESSION["user"], true);
            echo "<a href='admin.php'>List of customers</a> | <a href='logout.php'>Log Out</a>";
        } else {
            $user = json_decode($_SESSION["user"], true);
            echo "<a href='userpage.php'>( {$user["status"]} ) {$user["fname"]} {$user["sname"]}</a> | <a href='logout.php'>Log Out</a>";
        }
    }
    ?>
    </div>

</h1>
