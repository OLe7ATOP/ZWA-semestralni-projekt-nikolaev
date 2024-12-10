<?php
require_once "header.php";
?>

<h2 class="regheader">Login</h2>
<script src="scripts.js"></script>

<?php
if(isset($_SESSION["message"])){
    $message = $_SESSION["message"];
    echo "<div class='resultmessage'>";
    echo "<h3>{$message}</h3><br>";
    echo "<button onclick='closeMessage(this)' class='price'>OK</button>";
    echo "</div>";
    unset($_SESSION["message"]);
}
?>
<form action="login_check.php" method="post" class="login">
    <label for="mail">E-mail:</label>
    <input type="email" id="mail" name="mail" placeholder="example@your.mail" required>
    <label for="password">Set password:</label>
    <input type="password" id="password" name="pass" placeholder="Password" required>
    <button type="submit" class="price">Login</button>
</form>


<?php
require_once "footer.php";
?>
