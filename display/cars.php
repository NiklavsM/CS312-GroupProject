<?php
include_once "dependencies/header.php";

?>

    <div class="container">
        <h1>Our cars</h1>
        <div class="row">
            <div class="col-sm-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Filter</div>
                    <div class="panel-body">
                        <form id="selectCarsForm" method="post">
                            <table>
                                <tr>
                                    <td>Make:</td>
                                    <td>
                                        <select id="make" name="make">
                                            <option value="">Any</option>
                                            <option value="Ford">Ford</option>
                                            <option value="Audi">Audi</option>
                                            <option value="Merc">Merc</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Model:</td>
                                    <td>
                                        <select id="model" name="model">
                                            <option value="">Any</option>
                                            <option value="Fiesta">Fiesta</option>
                                            <option value="Audi">2</option>
                                            <option value="Merc">3</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Min:</td>
                                    <td><input type="number" min="0" name="minPrice" style="width: 3vw" placeholder="Min"></td>
                                </tr>
                                <tr>
                                    <td>Max:</td>
                                    <td><input type="number" min="0" name="maxPrice" style="width: 3vw" placeholder="Max"></td>
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
