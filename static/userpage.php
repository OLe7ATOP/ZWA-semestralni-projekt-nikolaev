<?php
require_once "header.php";
if(isset($_GET["id"])){
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

        foreach ($existingData as $userid => $userfromDB) {
            if ($userid == htmlspecialchars($_GET["id"])) {
                $visitedTrainer = $userfromDB;
                $visitedTrainer['id'] = $userid;
            }
        }


}
?>

<?php if(!isset($visitedTrainer)) : ?>
    <h2>
        <?php
        echo $user["status"];
        ?>
    </h2>
    <div class="trainermaininfo">
        <div class="image-cont">

            <?php
            $age = new DateTime();
            $age = $age->diff(new DateTime($user["dob"]))->y;
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
<?php if($user['status']!='admin'): ?>
    <h3>Schedule</h3>
        <?php if($user['status'] == 'trainer'): ?>
    <form action="createtraining.php" method="post">
        <button type="submit" class="price">CREATE NEW TRAINING</button>
    </form>

        <?php endif;?>
    <div class="schedule">

        <?php foreach ($user['trainings'] as $dow => $trainlist): ?>
        <div class="schedule-dayofweek">
            <h4><?php echo ucfirst($dow)?></h4>
            <?php foreach ($trainlist as $training): ?>
                <form class="schedule-items" action="delete_training.php" method="post">
                    <h3>GYM</h3>
                    <p><?php echo $training['start'] . " - " . $training['end']; ?></p>
                    <p>
                        <?php if ($user['status'] == 'trainer') {
                            echo $user['fname'] . " " . $user['sname'];
                        }  else {
                            echo $training['trainer']['fname'] . " " . $training['trainer']['sname'];
                        }?>
                    </p>
                    <input type="hidden" name="traininginfo" value="<?php echo $_SESSION['id'].'-'.$dow.'-'.$training['start']?>">
                    <?php if($user['status'] == 'trainer'): ?>
                    <button type="submit" class="deltraining">DELETE</button>
                    <?php else: ?>
                    <button type="submit" class="deltraining">SIGN OFF</button>
                    <?php endif; ?>
                    </form>
            <?php endforeach; ?>
        </div>



        <?php endforeach; ?>
    </div>
<?php endif;?>

<?php else: ?>

    <h2>
        <?php
        echo $visitedTrainer["status"];
        ?>
    </h2>
    <div class="trainermaininfo">
        <div class="image-cont">

            <?php

            $age = new DateTime();
            $age = $age->diff(new DateTime($visitedTrainer["dob"]))->y;
            if(isset($visitedTrainer['photo'])) {
                $file = glob("pictures/userpictures/{$visitedTrainer['photo']}");
            } else {
                $file = glob("pictures/userpictures/defaultuserpic.png");
            }
            if (!empty($file)) {
                echo "<img src='{$file[0]}' >";
            } else {
                echo "<p>  [  Image_Error ]  </p>";
            }
            ?>

        </div>

        <p>Hello! My name is <?php echo $visitedTrainer["fname"]?> ! <br><br>
            <?php
            if(isset($visitedTrainer['aboutme'])) {
                echo $visitedTrainer['aboutme'];
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
    <?php if($visitedTrainer['status']!='admin'): ?>
        <h3>Schedule</h3>
        <div class="schedule">
            <?php if(isset($visitedTrainer['trainings'])) :?>
            <?php foreach ($visitedTrainer['trainings'] as $dow => $trainlist): ?>
                <div class="schedule-dayofweek">
                    <h4><?php echo ucfirst($dow)?></h4>
                    <?php foreach ($trainlist as $training): ?>
                        <form class="schedule-items" action="signuptraining.php" method="post">
                            <h3>GYM</h3>
                            <p><?php echo $training['start'] . " - " . $training['end']; ?></p>
                            <p>
                                <?php echo $visitedTrainer['fname'] . " " . $visitedTrainer['sname']; ?>
                            </p>
                            <?php if(isset($user) && $user['status'] == 'customer'): ?>
                                <input type="hidden" name="traininginfo" value="<?php echo $visitedTrainer['id'].'-'.$dow.'-'.$training['start']?>">
                                <button type="submit" class="signup">SIGN UP</button>
                            <?php endif;?>
                        </form>
                    <?php endforeach; ?>

                </div>



            <?php endforeach; ?>
        <?php endif;?>
        </div>
    <?php endif;?>


<?php endif;?>
<?php
require_once "footer.php";
?>