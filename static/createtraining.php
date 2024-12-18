<?php
?>
<?php
require_once "header.php";
?>



<h2 class="regheader">Create new training</h2>
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
<form action="savetraining.php" method="post" enctype="multipart/form-data">
    <label for="dow">Day of the week?
        <select id="dow" name="dow" required>
            <option value="mon">Mon</option>
            <option value="tue">Tue</option>
            <option value="wed">Wed</option>
            <option value="thu">Thu</option>
            <option value="fri">Fri</option>
            <option value="sat">Sat</option>
            <option value="sun">Sun</option>
        </select>
    </label><br>
    <label for="dob">From <input type="time" id="time1" name="time1" required></label>
    <label for="dob">-To <input type="time" id="time2" name="time2" required></label><br>
    <button type="submit" class="price">Create</button>
    <button type="reset" class="resetbutton">Clear the info</button>
</form>


<?php
require_once "footer.php";
?>
