<?php
include_once "dependencies/header.php";

?>
    <script>
        $(function(){
            $('#location').on('change',function() {
                //get current selected item from carMaker
                var f = $('#location').val();
                //send f to dropDownHandler
                $.ajax({
                    url: 'instanceTable.php',
                    type: 'post',
                    data: {'location': f}
                }).done(function(msg) {
                    //insert html into selection
                    document.getElementById('tableResponsePlaceHolder').innerHTML = msg;
                })
                    .fail(function() { alert("error"); })
                    .always(function() {
                    });
            });
        });
    </script>


    <h1>Cars At Location</h1>
    <div class="row">
        <div class="col-sm-2">
            <div class="panel panel-info">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form id="selectCarLocationForm" method="post">
                        <table>
                            <tr><td>Location:</td><td><select id="location" name = "location">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="NA">All</option>
                                        <?php
                                        $locations = sqlgetLocation();
                                        while ($location = $locations->fetch_assoc()) {
                                            echo '<option value="'.$location['locationid'].'">'.$location['name'].' - '.$location['postcode'].'</option>';
                                        }
                                        ?>
                                    </select></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-10">
            <h2>Selected cars</h2>
            <div id="tableResponsePlaceHolder">

            </div>

        </div>
    </div>
<?php
include_once "dependencies/footer.php";
