<?php
session_start();

// Clearing all the info

$_SESSION["user"] = "";
$_SESSION["status"] = "unlogin";

header("Location: mainpage.php");
exit();