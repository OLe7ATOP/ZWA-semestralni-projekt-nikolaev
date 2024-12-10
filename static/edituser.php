<?php
session_start();

foreach ($_SESSION['usertoedit'] as $key => $value) {
    echo $key." = ".$value."<br>";
}
