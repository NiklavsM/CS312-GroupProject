<?php
include_once "database.php";

$dateFrom = input ("dateFrom");
$dateTo = input ("dateTo");
$typeid = input("typeid");
$location = input("location");
$username = input("username");


echo $location."   ";
echo $dateFrom."   ";
echo $dateTo."   ";
echo $typeid."   ";
echo $username."   ";


insertReservationByCar($location, $typeid, $username, $dateFrom, $dateTo);


