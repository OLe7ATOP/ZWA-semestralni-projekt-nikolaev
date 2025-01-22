<?php
require_once "header.php";
?>
<!-- Header file -->

<!--
Web Page for logging in
-->



<h2 class="regheader">Login</h2>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="loginscript.js"></script>


<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<form action="login_check.php" method="post" class="login" id="form">
    <label for="mail">E-mail:</label>
    <input type="email" id="mail" name="mail" placeholder="example@your.mail" required>
    <label for="password">Set password:</label>
    <input type="password" id="password" name="pass" placeholder="Password" required>
    <button type="submit" class="price">Login</button>
</form>



<!-- Footer file -->
<?php
require_once "footer.php";
?>
