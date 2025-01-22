<?php
require_once "header.php";
?>
<!-- Header file -->

<!--
 Web page for adding new
 trainings. For trainers only.
-->



<h2 class="regheader">Create new training</h2>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="trainingscript.js"></script>


<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<!-- Message form -->
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

<!-- Training form -->
<form action="savetraining.php" id="form" method="post" enctype="multipart/form-data">
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


<!-- Footer file -->
<?php
require_once "footer.php";
?>
