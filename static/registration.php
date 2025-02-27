<?php
?>
<?php
require_once "header.php";
?>
<!-- Header file -->

<!--
Registration page
 -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="regscript.js"></script>

<h2 class="regheader">Become a part of our BIG family</h2>

<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>


<!-- Registration form -->
<form action="save_form.php" method="post" enctype="multipart/form-data" id="form">
    <label for="firstname">Your first name: <input type="text" id="firstname" name="fname" placeholder="Jason" required></label>
    <label for="secondname">Your second name: <input type="text" id="secondname" name="sname" placeholder="Statham" required></label><br>
    <label for="dob">Your date of birth: <input type="date" id="dob" name="dob" required></label><br>
    <label for="gender">Your gender?
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="woman">Woman</option>
            <option value="mechanic">Mechanic</option>
            <option value="apache">Apache combat helicopter</option>
            <option value="sonic">Sonic the Hedgehog</option>
            <option value="other">Other</option>
        </select>
    </label><br>
    <label for="mail">E-mail: <input type="email" id="mail" name="mail" placeholder="example@your.mail" required></label><br>
    <label for="password">Set password: <input type="password" id="password" name="pass01" placeholder="Password" required></label>
    <label for="reppassword">Set password: <input type="password" id="reppassword" name="pass02" placeholder="Repeat password" required onchange="checkpass()"></label>
    <label for="img">Any image? <label class="custom-input-but"><input type="file" id="img" name="profilephoto" accept="image/*" onchange="displayname()">Load Image</label></label><br>
    <p id="loadedimage">Load your image</p><br>
    <legend>Tell us something about yourself</legend>
    <textarea id="aboutme" name="aboutme" cols="50" rows="10"></textarea>
    <button type="submit" class="price">Registrate</button>
    <button type="reset" class="resetbutton">Clear the info</button>
</form>



<!-- Footer file -->
<?php
require_once "footer.php";
?>
