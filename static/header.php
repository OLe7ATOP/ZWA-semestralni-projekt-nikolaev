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
    <script src="scripts.js"></script>
</head>
<body>
<h1><a href="mainpage.php" class="mainlink">GYM in Prague</a>
    <div class="personallinks">
    <?php
    if(!isset($_SESSION["status"]) || $_SESSION["status"] == "unlogin") {
        echo "<a href='login.php'>Log In</a> | <a href='registration.php'>Register</a>";
    } else {
        $user = $_SESSION["user"];
        if($_SESSION["status"] == "admin") {
            echo "<a href='admin.php'>List of customers</a> |<a href='userpage.php'> ADMIN </a>| <a href='logout.php'>Log Out</a>";
        } else {
            echo "<a href='userpage.php'>{$user["fname"]} {$user["sname"]}</a> | <a href='logout.php'>Log Out</a>";
        }
    }
    ?>
    </div>


</h1>
