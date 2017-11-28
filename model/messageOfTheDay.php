<?php
include_once "database.php";
$types = sqlgetCarTypes();
$rowCount = $types->num_rows;
if($rowCount > 0) {
    $val = rand(0, $rowCount);
    for($i = 0; $i < $rowCount; $i ++){
        $instance = $types->fetch_assoc();
        if($i === $val){
            echo '<img src="../img/'.$instance["img"].'" alt="Car with make '.$instance["make"].' and model '.$instance["model"].'" height="200" width="200"><br>';
            echo '<h4>Why not take our  ' . $instance["make"] . ' ' . $instance["model"] . " for a spin and maybe you might find your true love.</h4></br>";
            echo "<h6>Warning when renting your car you will have to provide your own insurance, fuel*, personnel to drive the vehicle and you will need to pay extra if you want the car to be checked before the rental.</h6></br>";
            echo "<h6>* fuel defined as petrol or gasoline that is required for the car to travel and for hybrids it means that you will need to supply your own battery";
        }
    }
} else {
    echo "We are sorry but we cant serve your people round these parts";
}
