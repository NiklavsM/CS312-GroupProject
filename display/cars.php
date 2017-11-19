<?php
include_once "dependencies/header.php";

?>
<script>
    $(function(){
        $('#make').on('change',function() {
            //get current selected item from carMaker
            var f = $('#make').val();
            //send f to dropDownHandler
            $.ajax({
                url: '~/../../model/dropDownHandler.php',
                type: 'post',
                data: {'maker': f}
            }).done(function(msg) {
                //insert html into selection
                document.getElementById('model').innerHTML = msg;
            })
                .fail(function() { alert("error"); })
                .always(function() {
                });
        });
    });
</script>

    <div class="container">
        <h1>Our cars</h1>
        <div class="row">
            <div class="col-sm-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Filter</div>
                    <div class="panel-body">
                        <form id="selectCarsForm" method="post">
                            <table>
                                <tr><td>Make:</td><td><select id="make" name = "make">
                                            <option value="" selected>Any</option>
                                            <?php
                                            $carTypes = sqlGetCarsMakers();
                                            while ($type = $carTypes->fetch_assoc()) {
                                                echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
                                            }
                                            ?>
                                        </select></td></tr>
                                <tr><td>Model:</td><td><select id="model" name ="model">
                                            <option value="" selected>Any</option>
                                        </select></td></tr>
                                <tr>
                                    <td>Min:</td>
                                    <td><input id="min" type="number" min="0" name="minPrice" style="width: 3vw" placeholder="Min"></td>
                                </tr>
                                <tr>
                                    <td>Max:</td>
                                    <td><input id="max" type="number" min="0" name="maxPrice" style="width: 3vw" placeholder="Max"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Filter" class="btn btn-success"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <h2>Selected cars</h2>
                <div id="tablePlaceHolder">

                </div>

            </div>
        </div>
    </div>
    <script type='text/javascript' src = "js/cars.js"></script>
<?php
include_once "dependencies/footer.php";
