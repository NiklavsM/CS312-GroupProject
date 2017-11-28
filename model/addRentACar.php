<?php
include_once "database.php";

$dateFrom = input("dateFrom");
$dateTo = input("dateTo");
$typeid = input("typeid");
$location = input("location");
$username = input("username");


if (insertReservationByCar($location, $typeid, $username, $dateFrom, $dateTo)) {
    echo "Reservation successful";
} else {
    echo "Reservation unsuccessful, this car has already been rented";
}
