<?php
include_once "~../../../model/database.php";
if(isset($_POST['reservUserName'])){
    $userVal = input('reservUserName');
    if($userVal != "") {
        $reservations = getAdminUserReservation($userVal);
    } else {
        $reservations = getAllReservations();
    }
} else {
    $reservations = getAllReservations();
}
//https://www.youtube.com/watch?v=7jTgkTEDDog

echo "<table class='table'>";
echo "<tr><td>User Name</td></td><td>Start Date</td><td>End Date</td><td>Make</td><td>Model</td><td>Location</td><td>Active</td></tr>";
while ($fetch = $reservations->fetch_assoc()) {
    echo "<tr><td>" .
        $fetch["username"] . "</td><td>" .
        $fetch["startdate"] . "</td><td>" .
        $fetch["enddate"] . "</td><td>" .
        $fetch["make"] . "</td><td>"
        . $fetch["model"] . "</td><td>"
        . $fetch["name"] . "</td><td>"
        . $fetch["active"] .
        "</td><td><form id=\"invalidationForm\" method='post'><input name='hiddenID' id='hiddenID' type='hidden' value='" . $fetch["reservationid"] . "'>";
        if($fetch["active"] === 1){
            echo "<input type='submit' id='buttDisapear' name='buttDisapear' value = 'Disable' class='btn btn-success'></form></td>";
        }
        echo "</tr>";
}
