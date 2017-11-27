<?php
include_once "dependencies/header.php";

?>


    <h1>Our cars</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form id="selectCarsForm" method="post">

                        <label for="make">Make:</label>
                        <select id="make" name="make">
                            <option value="" selected>Any</option>
                            <?php
                            $carTypes = sqlGetCarsMakers();
                            while ($type = $carTypes->fetch_assoc()) {
                                echo '<option value=' . $type['make'] . '>' . $type['make'] . '</option>';
                            }
                            ?>
                        </select>
                        <label for="model">Model: </label>
                        <select id="model" name="model">
                            <option value="" selected>Any</option>
                        </select>

                        <label for="min">Min: </label>
                        <input id="min" type="number" min="0" name="minPrice" placeholder="Min">

                        <label for="max">Max: </label>
                        <input id="max" type="number" min="0" name="maxPrice" placeholder="Max">

                        <input type="submit" value="Filter" class="btn btn-success">

                    </form>
                </div>
            </div>
        </div>
    </div>

        <h2>Selected cars</h2>
        <div id="tablePlaceHolder">

        </div>

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

        window.onload = loadCars;
    </script>
    <script type='text/javascript' src="js/cars.js"></script>
<?php
include_once "dependencies/footer.php";
