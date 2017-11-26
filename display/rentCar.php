<?php
include_once "dependencies/header.php";

$typeid = input("typeid");
$maker = input("make");
$model = input("model");
$price = input("price");
$img = input("img");

if (isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript" src="js/rentCar.js"></script>
    <div class="panel panel-info">
        <div class="panel-heading">Checkout</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <table class="table">

                        <tr>
                            <td>Make:</td>
                            <td><?php echo $maker ?></td>
                        </tr>
                        <tr>
                            <td>Model:</td>
                            <td><?php echo $model ?></td>
                        </tr>
                        <tr>
                            <td>Price Per Day:</td>
                            <td id="pricePerDayId"><?php echo $price ?></td>
                        </tr>

                        <form method="post" action="~/../../model/addRentACar.php" onsubmit="">

                            <tr>
                                <td>Date From:</td>
                                <td><input id="dateFromId" type="date" name="dateFrom" required
                                           onchange="calculatePrice()"></td>
                            </tr>
                            <tr>
                                <td>Date To:</td>
                                <td><input id="dateToId" type="date" name="dateTo" required onchange="calculatePrice()">
                                </td>
                            </tr>

                            <?php
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
                            ?>
                            <tr>
                                <td>Total: £</td>
                                <td id="priceToPayId"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="RENT" class="btn btn-success pull-right"></td>
                            </tr>


                        </form>

                    </table>
                </div>
                <div class="col-sm-8">

                        <img src="../img/<?php echo $img; ?>" alt="Picture of car">;

                </div>
            </div>
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
