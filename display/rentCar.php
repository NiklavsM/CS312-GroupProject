<?php
include_once "dependencies/header.php";

?>
<script>
    function currentDate(){
        var today = new Date();
        var mm = today.getMonth()+1; //January is 0!
        var dd = today.getDate();
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        }
        if(mm<10){
            mm='0'+mm;
        }
        var today = yyyy +'-'+mm+'-'+dd;
        $('#dateFromId').attr('min', today);
    }
    $(function(){
        currentDate();
        $('#dateFromId').on('change',function(){
            var date = $('#dateFromId').val();
            var dates = date.split("-");
            var d = new Date();
            d.setFullYear(dates[0], dates[1]-1, dates[2]);
            d.setDate(d.getDate() + 1);
            var day;
            var month;
            if(d.getDate() < 10){
                day = '0'+d.getDate();
            }else{
                day = d.getDate();
            }
            if((d.getMonth()+1) < 10){
                month = '0'+(d.getMonth()+1);
            }else{
                month = (d.getMonth()+1);
            }
            var date = d.getFullYear()+'-'+month+'-'+day;
            $('#dateToId').attr("min",date);
        });
        $('#dateToId').on('change',function(){
            var date = $('#dateToId').val();
            var dates = date.split("-");
            var d = new Date();
            d.setFullYear(dates[0], dates[1]-1, dates[2]);
            d.setDate(d.getDate() - 1);
            var day;
            var month;
            if(d.getDate() < 10){
                day = '0'+d.getDate();
            }else{
                day = d.getDate();
            }
            if((d.getMonth()+1) < 10){
                month = '0'+(d.getMonth()+1);
            }else{
                month = (d.getMonth()+1);
            }
            var date = d.getFullYear()+'-'+month+'-'+day;
            $('#dateFromId').attr("max",date);
        });
        $('#addRentForm').on('submit',function(e) {
            e.preventDefault();
            var dateFrom = $('#dateFromId').valueOf();
            var dateTo = $('#dateToId').valueOf();

            document.getElementById('rentingResponse').innerHTML = "";
            var form_data = new FormData($('#addRentForm')[0]);
            $.ajax({
                url: '~/../../model/addRentACar.php',
                type: 'post',
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                data: form_data,
                success: function(msg){
                    document.getElementById('rentingResponse').innerHTML = "";
                    document.getElementById('rentingResponse').innerHTML = msg;
                    if(msg === "Success"){
                        document.getElementById("rentingResponse").className = "alert alert-success";
                    }else{
                        document.getElementById("rentingResponse").className = "alert alert-warning";
                    }
                }
            });
        });
    });
</script>
<?php

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
            <div id="rentingResponse"></div>
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

                        <form method="post" id="addRentForm">

                            <tr>
                                <td>Date From:</td>
                                <td><input id="dateFromId" type="date" name="dateFrom" min="<?php echo date("m-d-Y"); ?>" required
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
                            echo '<input type="hidden" name="typeid" value="' . $typeid . '">';
                            echo '<input type="hidden" name="username" value="' . $_SESSION['username'] . '">';
                            ?>
                            <tr>
                                <td>Total: £</td>
                                <td id="priceToPayId"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input id="addRentSubmit" type="submit" value="RENT" class="btn btn-success pull-right"></td>
                            </tr>


                        </form>

                    </table>
                </div>
                <div class="col-sm-8">
                    <?php
                    if (file_exists("../img/".$img)) {
                       ?>
                        <img src="../img/<?php echo $img; ?>" class ="img-responsive" alt="Picture of car" width="500" height="500">
                    <?php
                    } else {
                        ?>
                        No Image Available;
                    <?php
                    }
                    ?>
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
