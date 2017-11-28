<?php
include_once "dependencies/header.php";
?>
<script>
    $(function () {
            $('#reservationUsername').on('change', function () {
                    var values = $('#reservationUsername').val();
                    $.ajax(
                        {
                            url: '~/../../model/userReservationTable.php',
                            type: 'post',
                            data: {'reservUserName': values}
                        }
                    ).done(function (data) {
                        document.getElementById("userReservations").innerHTML = data;
                    });
                }
            )
        }
    )
</script>
<?php
if (isset($_POST['hiddenID'])) {
    $id = input('hiddenID');
    invalidateReservation($id);
    echo '<div class="panel panel-info">';
    echo "<p>The disabling of the reservation was successful</p>";
    echo "</div>";
}
if ($successfulLogin && isset($_SESSION['username'])) {
    if (getUserRights($_SESSION['username'] > 0)) {
        ?>
        <h1>Reservations</h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Filter</div>
                    <div class="panel-body">
                        <form id="reservationRemove" method="post">
                            User:
                            <select id="reservationUsername" name="reservationUsername">
                                <option value="" selected>All</option>
                                <?php
                                $users = sqlGetUsers();
                                while ($user = $users->fetch_assoc()) {
                                    echo "<option value= " . $user["username"] . ">" . $user["username"] . "</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-sm-12">
            <div id="userReservations">
                <?php
                include_once '~/../../model/userReservationTable.php';
                ?>
            </div>
        </div>
        <?php
    } else {
        echo "<h3>You do not have the right access rights to access this section</h3>";
    }
} else {
    echo "<h3>You do not have access to this section, log in to access</h3>";
}


include_once "dependencies/footer.php";
