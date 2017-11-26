<?php
include_once "../display/dependencies/header.php";

$dateFrom = input("dateFrom");
$dateTo = input("dateTo");
$typeid = input("typeid");
$location = input("location");
$username = input("username");


if (insertReservationByCar($location, $typeid, $username, $dateFrom, $dateTo)) {
    ?>
    <div class="alert alert-success">
        <h3>Reservation successful</h3>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-warning">
        <h3>Reservation unsuccessful, this car has already been rented</h3>
    </div>
    <?php
}


include_once "../display/dependencies/footer.php";
