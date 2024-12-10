<?php
require_once "header.php";
$age = new DateTime();
$age = $age->diff(new DateTime($user["dob"]))->y;

?>
    <h2>
        <?php
        echo $user["status"];
        ?>
    </h2>
    <div class="trainermaininfo">
        <div class="image-cont">

            <?php
            if(isset($user['photo'])) {
                $file = glob("pictures/userpictures/{$user['photo']}");
                if (!empty($file)) {
                    echo "<img src='{$file[0]}' >";
                } else {
                    echo "<p>  [  Image_Error ]  </p>";
                }
            }
            ?>

        </div>

        <p>Hello! My name is <?php echo $user["fname"]?> ! <br><br>
            <?php
            if(isset($user['aboutme'])) {
                echo $user['aboutme'];
            }
            ?>
        </p>
        <div class="dropdown">
            <ul>
                <li> <?php echo "<u>Age</u>:<br>{$age}"?></li>
                <li><?php echo"<u>Experience</u>:<br> "?></li>
            </ul>
        </div>

    </div>
    <h3>Schedule</h3>


    <div class="schedule">

        <div class="schedule-dayofweek">
            <h4>Mon</h4>
            <div class="schedule-items">

                <?php
                if($trainer_spec != "gym"){
                    echo "<h5>Beginners</h5>";
                }
                ?>
                <p>13:45 - 15:45</p>
                <p><?php echo $trainer_name?></p>
            </div>
        </div>
        <div class="schedule-dayofweek">
            <h4>Tue</h4>

        </div>
        <div class="schedule-dayofweek">
            <h4>Wed</h4>
        </div>
        <div class="schedule-dayofweek">
            <h4>Thu</h4>
        </div>
        <div class="schedule-dayofweek">
            <h4>Fri</h4>
            <div class="schedule-items">
                <?php
                if($trainer_spec != "gym"){
                    echo "<h5>Beginners</h5>";
                }
                ?>
                <p>9:30 - 12:00 </p>
                <p><?php echo $trainer_name?></p>
            </div>
        </div>
        <div class="schedule-dayofweek">
            <h4>Sat</h4>
        </div>
        <div class="schedule-dayofweek">
            <h4>Sun</h4>

        </div>


    </div>


<?php
require_once "footer.php";
?>