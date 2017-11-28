<?php
include_once "database.php";
$types = sqlgetCarTypes();
$rowCount = $types->num_rows;
if($rowCount > 0) {
    $val = rand(0, $rowCount - 1);
    for($i = 0; $i < $rowCount; $i ++){
        $instance = $types->fetch_assoc();
        if($i === $val){
            ?>
<!--            <div class="col-sm-8">-->
                <?php
                if (file_exists("../img/".$instance["img"])) {
                    echo '<img src="../img/'.$instance["img"].'" class="img-responsive" alt="Car with make '.$instance["make"].' and model '.$instance["model"].'" height="500" width="500"><br>';
                } else {
                    echo 'No Image Available';
                }
                ?>
<!--            </div>-->
            <?php

            echo '<h4>Why not take our  ' . $instance["make"] . ' ' . $instance["model"] . " for a spin you might find your true love.</h4></br>";
            echo "<h6>Warning when renting your car you will have to provide your own insurance, fuel*, personnel to drive the vehicle and you will need to pay extra if you want the car to be checked before the rental.</h6></br>";
            echo "<h6>* fuel defined as petrol or gasoline that is required for the car to travel and for hybrids it means that you will need to supply your own battery";
        }
    }
} else {
    echo "We are sorry but we cant serve your people round these parts";
}
