<?php
$start = input("startTime");
$end   = input("endTime");
$carId = input("car");


if($start === "" || $end === "" || $carId === "") {
//TODO Error message to show error in input
} else if(!is_numeric($carId)){
//TODO Error the car id is not a int
} else if (!validateCarId($carId)){
//TODO Error input is not valid
} else {
    insertReservation($start, $end, True, $username, $carId);
}


