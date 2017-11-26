<?php
include_once "dependencies/header.php";

$typeid = input("typeid");
$maker = input("make");
$model = input("model");
$price = input("price");

if (isset($_SESSION['username'])) {
    ?>

    <div class="panel panel-info">
        <div class="panel-heading">Checkout</div>
        <div class="panel-body">
            <table>
                <?php
                echo '<tr>';
                echo '<td>Make:</td>';
                echo '<td>' . $maker . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Model:</td>';
                echo '<td>' . $model . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Price Per Day:</td>';
                echo '<td>' . $price . '</td>';
                echo '</tr>';
                echo '<form method="post" action="~/../../model/addRentACar.php" onsubmit="">';


                echo '<tr>';
                echo '<td>Date From:</td>';
                echo '<td><input type="date" name="dateFrom" required></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Date To:</td>';
                echo '<td><input type="date" name="dateTo" required></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<tr>';
                echo '<td>Location:</td><td><select id="location" name = "location" required>';
                echo '<option value="NA" selected disabled>Please Select</option>';
                $locations = sqlgetLocation();
                while ($location = $locations->fetch_assoc()) {
                    echo '<option value=' . $location['locationid'] . '>' . $location['name'] . ' - ' . $location['postcode'] . '</option>';
                }
                echo '</select></td></tr>';
                echo '<input type="hidden" name="typeid" value="' . $typeid . ' ">';
                echo '<input type="hidden" name="username" value="' . $_SESSION['username'] . '">';

                echo '<td><input type="submit" value="RENT" class="btn btn-success"></td>';
                echo '</tr>';


                echo '</form>'
                ?>
            </table>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="alert alert-warning">
        <h3>Please login to rent a car</h3>
        <button data-target="#login_box" class="btn btn-success" data-toggle="modal" style="color">Login</button>
    </div>
    <?php
}
include_once "dependencies/modals/login_modal.php";
include_once "dependencies/footer.php";
?>
