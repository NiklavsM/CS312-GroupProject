<?php
include_once "dependencies/header.php";

?>
    <script>
        $(function(){
            $('#location').on('change',function() {
                refresh();
            });
            $('input[type=radio][name=optradio]').change(function() {
                refresh();
            });
        });

        function transfer(id, locationid){
            console.log("button clicked");
            console.log("id:" + id + " locationid:"+locationid);
            $.ajax({
                url: 'transferCar.php',
                type: 'post',
                data: {'locationid': locationid, 'id':id}
            }).done(function(msg) {
                refresh();
            })
                .fail(function() {})
                .always(function() {
                });

        }

        function refresh(){
            var f = $('#location').val();
            var radio = $("input[name=optradio]:checked").val();
            //send f to dropDownHandler
            $.ajax({
                url: 'instanceTable.php',
                type: 'post',
                data: {'location': f, 'filter': radio}
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
                <div class="col-sm-12">
                    <h1>Cars At Location</h1>
                    <div class="panel panel-info">
                        <div class="panel-heading">Filter</div>
                        <div class="panel-body">
<!--                            <form id="selectCarLocationForm" method="post">-->
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
                                <label class="radio-inline"><input type="radio" name="optradio" value="1" checked="checked">All</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="2">Available</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="3">Rented</label>
                            <!--                            </form>-->
                        </div>
                    </div>
                </div>
    <div class="col-sm-12">
        <div id="tableResponsePlaceHolder"></div>
    </div>
<?php
include_once "dependencies/footer.php";
