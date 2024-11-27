<?php
    $title = $trainer_name;
require_once "header.php";
?>
<h2>
    <?php
    $spec = strtoupper($trainer_spec);
    echo "{$spec} Trainer";
    ?>
</h2>
<div class="trainermaininfo">
    <div class="image-cont">

        <?php
        $photo_name = strtolower($trainer_name);
        $photo_name = str_replace(' ', '', $photo_name);

        $file = glob("pictures/{$photo_name}.*");
        if(!empty($file)) {
            echo "<img src='{$file[0]}' alt='{$photo_name}'>";
        } else {
            echo "<p>  [  Image_Error ]  </p>";
        }
        ?>
    </div>
    <p>Hello! My name is <?php echo $trainer_name?> ! <br><br><?php echo $trainer_text?></p>
    <div class="dropdown">
        <ul>
            <li> <?php echo "<u>Age</u>:<br>{$trainer_age}"?></li>
            <li><?php echo"<u>Experience</u>:<br> {$trainer_exp}"?></li>
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