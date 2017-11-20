<?php
include_once "~../../../model/database.php";
$carid    = input("id");
$location   = input("transfer");

changeLocationOfCar($carid, $location);
?>
