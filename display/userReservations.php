<?php
include_once "dependencies/header.php";
if ($successfulLogin && isset($_SESSION['username'])) {
    $reservations = getUserReservation($username);
    if ($reservations->num_rows > 0) {
        echo " <div class=\"col-sm-12\">";
        echo "<table class='table'>";
        echo "<tr><td>Start Date</td><td>End Date</td><td>Make</td><td>Model</td><td>Location</td></tr>";
        while ($fetch = $reservations->fetch_assoc()) {
            echo "<tr><td>" . $fetch["startdate"] . "</td><td>" . $fetch["enddate"] . "</td><td>" . $fetch["make"] . "</td><td>" . $fetch["model"] . "</td><td>" . $fetch["name"] . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        ?>
        <div class="col-sm-12">
            <h3>You have not yet booked any rentals</h3>
        </div>
        <?php
    }
} else {
    ?>
    <div class="col-sm-12">
        <h3>You need to be logged in to use this page. Please log in</h3>
    </div>
    <?php
}


include_once "dependencies/footer.php";

?>
