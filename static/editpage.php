
<!--
Web page for editing user's info.
Available for administrator only
-->


<!-- Header file-->
<?php
require_once "header.php";
$usertoedit = $_SESSION['usertochange'];
?>


<!-- Err message form-->
<?php
if(isset($_SESSION["message"])){
    $message = htmlspecialchars($_SESSION["message"]);
    echo "<div class='resultmessage'>";
    echo "<h3>{$message}</h3><br>";
    echo "<button onclick='closeMessage(this)' class='price'>OK</button>";
    echo "</div>";
    unset($_SESSION["message"]);
}
?>

<!-- Form for editing data-->
<form action="save_changed_info.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="usertochangeid" value="<?php echo $_SESSION['usertochangeID'] ?>" >
    <label for="firstname">First name: <input type="text" id="firstname" name="fname" value="<?php echo $usertoedit['fname']?>" required></label>
    <label for="secondname">Second name: <input type="text" id="secondname" name="sname" value="<?php echo $usertoedit['sname']?>" required></label><br>
    <label for="dob">Date of birth: <input type="date" id="dob" name="dob" value="<?php echo $usertoedit['dob']?>" required></label><br>
    <label for="gender">Gender?
        <select id="gender" name="gender" required>
            <option value="male" <?php echo ($usertoedit['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="woman" <?php echo ($usertoedit['gender'] == 'woman') ? 'selected' : ''; ?>>Woman</option>
            <option value="mechanic" <?php echo ($usertoedit['gender'] == 'mechanic') ? 'selected' : ''; ?>>Mechanic</option>
            <option value="apache" <?php echo ($usertoedit['gender'] == 'apache') ? 'selected' : ''; ?>>Apache combat helicopter</option>
            <option value="sonic" <?php echo ($usertoedit['gender'] == 'sonic') ? 'selected' : ''; ?>>Sonic the Hedgehog</option>
            <option value="other" <?php echo ($usertoedit['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
        </select>
    </label><br>
    <?php if($usertoedit['status'] == 'trainer' && isset($usertoedit['spec'])): ?>
    <label for="spec">Specialisation?
        <select id="spec" name="spec" required>
            <option value="gym" <?php echo ($usertoedit['spec'] == 'gym') ? 'selected' : ''; ?>>GYM</option>
            <option value="kickbox" <?php echo ($usertoedit['spec'] == 'kickbox') ? 'selected' : ''; ?>>Kick-Boxing</option>
            <option value="mma" <?php echo ($usertoedit['spec'] == 'mma') ? 'selected' : ''; ?>>MMA</option>
            </select>
    </label><br>
    <?php endif;?>
    <label for="mail">E-mail: <input type="email" id="mail" name="mail" value="<?php echo $usertoedit['mail']?>" required></label><br>
    <legend>User Info: </legend>
    <?php
    if(isset($usertoedit["aboutme"])){
        echo "<textarea id=\"aboutme\" name=\"aboutme\" cols=\"50\" rows=\"10\" value=\"<?php echo {$usertoedit['aboutme']}?>\">{$usertoedit['aboutme']}</textarea> ";
    } else {
        echo "<textarea id=\"aboutme\" name=\"aboutme\" cols=\"50\" rows=\"10\"></textarea> ";
    }
    ?>
    <button type="submit" class="price">Save</button>
</form>



<!-- Footer file -->
<?php
require_once "footer.php";
?>
