<?php
include_once "dependencies/header.php";

?>
    <script>
        $(function(){
            $('#location').on('change',function() {
                refresh();
            });
        });

        function transfer(button){
            console.log("button clicked");
            var id = $(button).val();
//            var f = document.getElementById("transferList" + id).valueOf();
            var e = document.getElementById("transferList" + id);
            var f = e.options[e.selectedIndex].value;
//            var f = $('#transferList').val();
            console.log("id:" + id + " f:"+f);
            $.ajax({
                url: 'transferCar.php',
                type: 'post',
                data: {'transfer': f, 'id':id}
            }).done(function(msg) {
                refresh();
            })
                .fail(function() {})
                .always(function() {
                });

        }

        function refresh(){
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
                .fail(function() {})
                .always(function() {
                });
        }

        function handleDelete(button){
            var i = 1;
            var id = $(button).val();
            console.log("got here with:"+ id);
            $.ajax({
                url: 'transferCar.php',
                type: 'post',
                data: {'delete': i, 'id': id}
            }).done(function(msg) {
                console.log(msg);
                console.log("refreshing");
                refresh();
            })
                .fail(function() { })
                .always(function() {
                });
        }
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
