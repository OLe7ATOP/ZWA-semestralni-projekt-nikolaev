<?php
require_once "header.php";
?>


<?php

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
        echo "Ошибка декодирования JSON: " . json_last_error_msg();
        $existingData = [];
    }
} else {
    $existingData = [];
}
?>



<?php
if(isset($_SESSION["message"])){
    $message = $_SESSION["message"];
    echo "<form  action='admin.php' class='adminmessage'>";
    echo "<h3>{$message}</h3><br>";
    echo "<button type='submit' class='price'>OK</button>";
    echo "</form>";
    unset($_SESSION["message"]);
}
?>

<?php foreach ($existingData as $custId => $cust): ?>
    <div class="userstring">
    <div id="user_<?php echo $custId; ?>" class="listofusersinfo">
        <div class="image-cont">

            <?php
            if(isset($cust['photo'])) {
                $file = glob("pictures/userpictures/{$cust['photo']}");
                if (!empty($file)) {
                    echo "<img src='{$file[0]}' >";
                } else {
                    echo "<p>  [  Image_Error ]  </p>";
                }
            }

            if(!isset($cust['age'])) {
                $today = new DateTime();
                $age = $today->diff(new DateTime($cust["dob"]))->y;
            }
            ?>

        </div>

        <p><?php echo "( $custId )  ".$cust["fname"]." ".$cust["sname"]." "."[- {$cust['status']} -]"?> <br><br>

        </p>
        <div class="dropdown">
            <ul>
                <li> <?php echo "<u>Age</u>:<br>{$age}"?></li>
                <li><?php echo"<u>Experience</u>:<br> "?></li>
            </ul>
        </div>

    </div>

        <?php if($_SESSION['id']!=$custId): ?>
        <form class="admineditplace" action="makeatrainer.php" method="post">
            <input type="hidden" name="usertochangeid" value="<?php echo $custId; ?>" >
            <button type='submit' name='action' value='edit'  class="editcustomerbut">EDIT</button>
            <button type='submit' name='action' value='resetpass'  class="editcustomerbut">RESET PASSWORD</button>
            <?php if($cust['status']=='customer'){
                echo "<button type='submit' name='action' value='makeatrainer' class='makeatrainerbut'>MAKE A TRAINER</button>";
                echo "<button type='submit' name='action' value='makeanadmin' class='makeatrainerbut'>MAKE AN ADMIN</button>";
            }
            if($cust['status']=='trainer'){
                echo "<button type='submit' name='action' value='makeacustomer' class='makeatrainerbut'>MAKE A CUSTOMER</button>";
                echo "<button type='submit' name='action' value='makeanadmin' class='makeatrainerbut'>MAKE AN ADMIN</button>";
            }
            if($cust['status']=='admin'){
                echo "<button type='submit' name='action' value='makeacustomer' class='makeatrainerbut'>MAKE A CUSTOMER</button>";
                echo "<button type='submit' name='action' value='makeatrainer' class='makeatrainerbut'>MAKE AN TRAINER</button>";
            }
            ?>
            <button type='submit' name='action' value='delete'  class="deletebut">DELETE</button>
        </form>
    <?php endif;?>
    </div>
<?php endforeach; ?>






<?php
require_once "footer.php";
