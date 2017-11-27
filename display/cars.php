<?php
include_once "dependencies/header.php";

?>
    <script>
        $(function () {
            $('#make').on('change', function () {
                //get current selected item from carMaker
                var f = $('#make').val();
                //send f to dropDownHandler
                $.ajax({
                    url: '~/../../model/dropDownHandler.php',
                    type: 'post',
                    data: {'make': f}
                }).done(function (msg) {
                    //insert html into selection
                    document.getElementById('model').innerHTML = msg;
                })
                    .fail(function () {
                        alert("error");
                    })
                    .always(function () {
                    });
            });
        });
    </script>


    <h1>Our cars</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form id="selectCarsForm" method="post">
                        <div class="form-group row">
                            <div class="col-xs-4">
                                Make:<select id="make" name="make">
                                    <option value="" selected>Any</option>
                                    <?php
                                    $carTypes = sqlGetCarsMakers();
                                    while ($type = $carTypes->fetch_assoc()) {
                                        echo '<option value=' . $type['make'] . '>' . $type['make'] . '</option>';
                                    }
                                    ?>
                                </select>
                                Model:<select id="model" name="model">
                                    <option value="" selected>Any</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                Min:
                                <input id="min" type="number" min="0" name="minPrice" placeholder="Min">
                            </div>
                            <div class="col-xs-2">
                                Max:
                                <input id="max" type="number" min="0" name="maxPrice" placeholder="Max">
                            </div>

                            <div class="col-xs-2">
                                <input type="submit" value="Filter" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <h2>Selected cars</h2>
        <div id="tablePlaceHolder">

        </div>

    </div>

    <script type='text/javascript' src="js/cars.js"></script>
<?php
include_once "dependencies/footer.php";
