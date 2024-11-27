<?php
session_start();

$_SESSION["user"] = "";
$_SESSION["status"] = "unlogin";

header("Location: mainpage.php");
exit();