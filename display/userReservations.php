<?php
include_once "dependencies/header.php";
if ($successfulLogin && isset($_SESSION['username'])) {
    $reservations = getUserReservation($username);
    if ($reservations->num_rows > 0) {
        echo "<table>";
        echo "<tr><td>Start Date</td><td>End Date</td><td>Make</td><td>Model</td><td>Location</td></tr>";
        while($fetch = $reservations->fetch_assoc()){
            echo "<tr><td>".$fetch["startdate"]."</td><td>".$fetch["enddate"]."</td><td>".$fetch["make"]."</td><td>".$fetch["model"]."</td><td>".$fetch["name"]."</td></tr>";
        }
        echo "</table>";
    } else {
        ?>
            <h3>You have not yet booked any rentals</h3>
        <?php
    }
} else {
    ?>
    <h3>You need to be logged in to use this page. Please log in</h3>
    <?php
}


include_once "dependencies/footer.php";

?>
