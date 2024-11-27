
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

    <div class="schedule-dayofweek">
        <h4>Mon</h4>
        <div class="schedule-items">
            <h5>Beginners</h5>
            <p>13:45 - 15:45</p>
            <p>Alex Makaka</p>
        </div>
    </div>
    <div class="schedule-dayofweek">
        <h4>Tue</h4>

    </div>
    <div class="schedule-dayofweek">
        <h4>Wed</h4>
        <div class="schedule-items">
            <h5>Advanced</h5>
            <p>10:00 - 12:00</p>
            <p>Khabib Nurmagomedov</p>
        </div>
        <div class="schedule-items">
            <h5>Beginners</h5>
            <p>13:00 - 15:00</p>
            <p>Alex Makaka</p>
        </div>
    </div>
    <div class="schedule-dayofweek">
        <h4>Thu</h4>
    </div>
    <div class="schedule-dayofweek">
        <h4>Fri</h4>
        <div class="schedule-items">
            <h5>Beginners</h5>
            <p>13:45 - 15:45</p>
            <p>Alex Makaka</p>
        </div>
    </div>
    <div class="schedule-dayofweek">
        <h4>Sat</h4>
        <div class="schedule-items">
            <h5>Advanced</h5>
            <p>7:00 - 9:00</p>
            <p>Khabib Nurmagomedov</p>
        </div>
    </div>
    <div class="schedule-dayofweek">
        <h4>Sun</h4>

    </div>


</div>
