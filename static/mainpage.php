<?php
require_once "header.php";
?>

<!-- Header file -->

<!--
Main page of the WebSite
-->

<!-- DB download-->
<?php
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
        echo "JSON Decoding Err: " . json_last_error_msg();
        $existingData = [];
    }
} else {
    $existingData = [];
}
//Sorting for the trainers
$trainerlist = [];
foreach ($existingData as $userid => $userfromDB) {
    if($userfromDB['status'] == 'trainer'){
        $userfromDB['id'] = $userid;
        $trainerlist[] = $userfromDB;
    }
}
?>
<div class="info">
    <img class="ava" src="pictures\banner.bmp" />

    <h3>About Us:</h3>
    <p>
        GYM in Prague with a lot of sport secrions.
        A large room with separate halls for separate sections.
        Long time working with a lot of clients and local champions.
        <br />
        <img src="pictures\voskl_znak.png" class="voskl" style="float: left;" />
        <img src="pictures\voskl_znak.png" class="voskl" style="float: right;" />
    <ul>
        <li>First training <strong>! FREE !</strong></li>
        <li>Little shop at the reception with nutrition and sport gear</li>
        <li>Professional trainers with big experience</li>
    </ul>
    <div style="clear: left;"></div>
    </p>
</div>

<h2>Training sections</h2>
<div class="section-list">
    <div class="sections">
        <a href="gym.php">
        <img src="pictures\gym-banner.jpg" />
        <h3>GYM</h3>

        <p>
            Big training hall with a lot of
            inventory. We have group of qualified trainers, who will help you in case
            your need help.
        </p>
        </a>
    </div>

    <div class="sections">
        <a href="kickboxing.php">
        <img src="pictures\kickboxing.jpg" />
        <h3>Kick-Boxing</h3>

        <p>
            Kick-boxing section for adults and kids. Different groups for different ages.
            Trainers who are in practise and ready to train you all they know.

        </p>
        </a>
    </div>

    <div class="sections">
        <a href="mma.php">
        <img src="pictures\mma.jpg" />
        <h3>MMA</h3>

        <p>
            MMA sections for people who wants to try new styles of fighting.
            We would recomend it for people, who already have exeprience in
            professional fighting.
        </p>
        </a>
    </div>
</div>

<div style="clear: left;"></div>

<h2>Our trainers</h2>
<div class="trainers">

    <!-- Trainer list -->
    <?php for ($i=0;$i<sizeof($trainerlist); $i+=2) :?>
        <div class="trener1">
            <a href="userpage.php?id=<?php echo $trainerlist[$i]['id'];?>">
                <?php
                if(isset($trainerlist[$i]['photo'])) {
                    $file = glob("pictures/userpictures/{$trainerlist[$i]['photo']}");
                } else {
                    $file = glob("pictures/userpictures/defaultuserpic.png");
                }
                if (!empty($file)) {
                    echo "<img src='{$file[0]}' >";
                } else {
                    echo "<p>  [  Image_Error ]  </p>";
                }
                ?>

                <div class="trenerinfo">

                    <h3><?php echo $trainerlist[$i]['fname']." ".$trainerlist[$i]['sname']?></h3>


                    <p>
                        <?php
                        if(isset($trainerlist[$i]['aboutme'])){
                            echo $trainerlist[$i]['aboutme'];
                        }
                        ?>
                    </p>


                </div>
            </a>
        </div>

<img class="icon" src="pictures\dumbell.png" />
<?php if($i+1<sizeof($trainerlist)) :?>
<div class="trener1">
            <a href="userpage.php?id=<?php echo $trainerlist[$i+1]['id'];?>">
                <?php
                if(isset($trainerlist[$i+1]['photo'])) {
                    $file = glob("pictures/userpictures/{$trainerlist[$i+1]['photo']}");
                } else {
                    $file = glob("pictures/userpictures/defaultuserpic.png");
                }
                if (!empty($file)) {
                    echo "<img src='{$file[0]}' >";
                } else {
                    echo "<p>  [  Image_Error ]  </p>";
                }
                ?>

                <div class="trenerinfo">

                    <h3><?php echo $trainerlist[$i+1]['fname']." ".$trainerlist[$i+1]['sname']?></h3>


                    <p>
                        <?php
                        if(isset($trainerlist[$i+1]['aboutme'])){
                            echo $trainerlist[$i+1]['aboutme'];
                        }
                        ?>
                    </p>


                </div>
            </a>
        </div>
        <?php endif;?>

<?php endfor;?>
</div>

<h2>Our champions</h2>

<div class="kids">
    <img src="pictures\kid2.png" />

    <div class="kidinfo">
        <h3>Jihny Wonderful <br />Kick-Boxing</h3>
        <p>
            This girl had won for us a lot of medals and first places. She's been training in our GYM for 4 years
            and now she's already showing really beutiful results.
        </p>
    </div>
</div>


<div class="kids">
    <img src="pictures\kid1.png" />

    <div class="kidinfo">
        <h3>Billy Red <br /> MMA</h3>
        <p>
            Billy won three world championships in Kick-boxing. As he's saying: 'It's only the begining' and we trully believe in it.

        </p>
    </div>
</div>

<div style="clear: left"></div>

<h2>Season tickets</h2>
<div class="ticketlist">
    <div class="tickets">
        <img src="pictures\warrior1.png" />

        <div class="tickinfo">
            <h3>Padawan</h3>
            <ul>
                <li> For beginners.</li>
                <li> Single visit for 2 hours.</li>
            </ul>
        </div>
        <button class="price"> $2</button>
    </div>

    <div class="tickets">
        <img src="pictures\warrior2.png" />

        <div class="tickinfo">
            <h3>Soldier</h3>
            <ul>
                <li> For Advanced.</li>
                <li> 2-3 visits per week.</li>
                <li> 1 month</li>
            </ul>
        </div>
        <button class="price"> $18</button>
    </div>

    <div class="tickets">
        <img src="pictures\warrior3.png" />

        <div class="tickinfo">
            <h3>Veteran</h3>
            <ul>
                <li> For Professionals.</li>
                <li> 4-5 visits per week.</li>
                <li> For six month.</li>
                <li>-5% on products</li>
            </ul>
        </div>
        <button class="price"> $95</button>
    </div>

    <div class="tickets">
        <img src="pictures\warrior4.png" />

        <div class="tickinfo">
            <h3>God Of War</h3>
            <ul>
                <li> For BIG FREAKING GUYS.</li>
                <li> &infin; visits per week.</li>
                <li> For one year</li>
                <li>-10% on products</li>
            </ul>
        </div>
        <button class="price"> $150</button>
    </div>

</div>



<h2>Our social media and Contacts</h2>
<div class="contacts">
    <a href="https://www.google.com/maps/search/Tan��c�+d�m/@50.0754869,14.4120188,17z/data=!3m1!4b1" target="_blank"> <img src="pictures\Address.png" /></a>
    <ul>
        <li>Facebook: <a href="https://www.facebook.com">Facebook</a></li>
        <li>Instagramm: <a href="https://www.instagram.com">Instagram</a></li>
        <li>Our YouTube chanel: <a href="https://www.youtube.com">YouTube</a></li>
        <li>WhatsApp:<a> +123456789</a></li>
        <li>Mail: <a href="mailto:example@mail.com">example@mail.com</a> </li>
        <li>Telephone Number:<a> +123456789</a></li>
        <li>Address: <br /> <a href="https://maps.app.goo.gl/ahgU1wNn7dWDng9t9" target="_blank">Jiráskovo nám. 1981/6, 120 00 Nové Město</a></li>
    </ul>
</div>


<!-- Footer file -->
<?php
require_once "footer.php";
?>
