
<?php

/*
 * Pattern for the sections pages
 */

 //Download DB
$filepath = __DIR__ . '\jsondb\userinfo.json';


if (file_exists($filepath)) {
    $jsonContent = file_get_contents($filepath);
    $existingData = json_decode($jsonContent, true);

    if ($jsonContent === false) {
        $_SESSION["message"] = "DB access error";
        $err = true;
        header("Location: mainpage.php");
        exit();
    }

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Ошибка декодирования JSON: " . json_last_error_msg();
        $existingData = [];
    }
} else {
    $existingData = [];
}

/*
 * Schedule for this section is made
 * out of trainers schedules
 */
$pageSchedule = [
    'mon' => [],
    'tue' => [],
    'wed' => [],
    'thu' => [],
    'fri' => [],
    'sat' => [],
    'sun' => []
];

//Adding trainings to the list
foreach($existingData as $userfromDB){
    if ($userfromDB['status'] == 'trainer' && $userfromDB['spec'] == $section) {
        if (isset($userfromDB['trainings'])) {
            foreach ($userfromDB['trainings'] as $dow => $training) {
                foreach ($training as $train) {
                    $finaltrainingObj['start'] = $train['start'];
                    $finaltrainingObj['end'] = $train['end'];
                    $finaltrainingObj['trainer']['fname'] = $userfromDB['fname'];
                    $finaltrainingObj['trainer']['sname'] = $userfromDB['sname'];
                    $finaltrainingObj['spec'] = $section;
                    $pageSchedule[$dow][] = $finaltrainingObj;
                }
                usort($pageSchedule[$dow], function ($a, $b) {
                return $a['start'] <=> $b['start'];
            });
            }
        }

    }

}
?>

<h3 class="page-name">
    <?php echo $title; ?>
</h3>

<div class="info">
    <?php echo $page_text; ?>
</div>

<div class="photos">
    <?php
    for($i=1;$i<=5;$i++) {
        echo "<img src='pictures/{$photo_name}_{$i}.jpg'>";
    }
    ?>
</div>

<h3>Schedule</h3>

<div class="schedule">

<!-- Printing trainings-->
    <?php foreach ($pageSchedule as $dow => $trainlist): ?>
    <div class="schedule-dayofweek">
        <h4><?php echo ucfirst($dow)?></h4>
        <?php foreach ($trainlist as $training): ?>
            <form class="schedule-items" method="post">
                <p><?php echo $training['start'] . " - " . $training['end']; ?></p>
                <p>
                    <?php
                        echo $training['trainer']['fname'] . " " . $training['trainer']['sname'];
                    ?>
                </p>
            </form>
        <?php endforeach; ?>


</div>

    <?php endforeach;?>