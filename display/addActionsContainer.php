<?php
include_once "dependencies/header.php";
/**
 * Created by IntelliJ IDEA.
 * User: mfb15135
 * Date: 24/11/2017
 * Time: 15:52
 */
?>

    <script>
        $(function(){
            $('#makeincar').on('change',function() {
                //get current selected item from carMaker
                var f = $('#makeincar').val();
                //send f to dropDownHandler
                $.ajax({
                    url: '~/../../model/dropDownHandler.php',
                    type: 'post',
                    data: {'make': f, 'addCar':"true"}
                }).done(function(msg) {
                    //insert html into selection
                    document.getElementById('modelincar').innerHTML = msg;
                })
                    .fail(function() { alert("error"); })
                    .always(function() {
                    });
            });
            $('#addTypeForm').on('submit', function (e) {
                e.preventDefault();
                if(validateTypeForm()){
                    var form_data = new FormData($('#addTypeForm')[0]);
                    $.ajax({
                        url: '~/../../model/addCarTypeHandler.php',
                        type: 'post',
                        processData: false,
                        contentType: false,
                        async: false,
                        cache: false,
                        data: form_data,
                        success: function(msg){
                            document.getElementById('msgType').innerHTML = "";
                            if(msg === "Success"){
                                document.getElementById('msgType').innerHTML = "Car Type Successfully Added.";
                                document.getElementById("addTypeDiv").className = "panel panel-primary";
                            }else{
                                document.getElementById('msgType').innerHTML = msg;
                                document.getElementById("addTypeDiv").className = "panel panel-danger";
                            }
                        }
                    });
                }
            });
            $('#addCarForm').on('submit', function (e) {
                e.preventDefault();
                if(validateCarForm()){

                    var make = $('#makeincar').val();
                    var location = $('#location').val();
                    var model = $('#modelincar').val();
                    $.ajax({
                        url: '~/../../model/addCarInstanceHandler.php',
                        type: 'post',
                        data: {'make': make, 'model':model, 'location':location}
                    }).done(function(msg) {
                        console.log("Message: " + msg);
                        document.getElementById('msgCar').innerHTML = "";
                        if(msg === "Success"){
                            document.getElementById('msgCar').innerHTML = "Car Successfully Added.";
                            document.getElementById("addCarDiv").className = "panel panel-primary";
                        }else{
                            document.getElementById('msgCar').innerHTML = msg;
                            document.getElementById("addCarDiv").className = "panel panel-danger";
                        }
                    })
                        .fail(function() { alert("error"); })
                        .always(function() {
                        });
                }

            });
            $('#addLocForm').on('submit', function (e) {
                e.preventDefault();
                if(validateLocationForm()){
                    var name = $('#name').val();
                    var number = $('#phoneNumber').val();
                    var postcode = $('#postcode').val();
                    $.ajax({
                        url: '~/../../model/addNewHubLocationHandler.php',
                        type: 'post',
                        data: {'name': name, 'number':number, 'postcode':postcode}
                    }).done(function(msg) {
                        document.getElementById('msgLoc').innerHTML = "";
                        if(msg === "Success"){
                            document.getElementById('msgLoc').innerHTML = "Location Successfully Added.";
                            document.getElementById("addLocDiv").className = "panel panel-primary";
                        }else{
                            document.getElementById('msgLoc').innerHTML = msg;
                            document.getElementById("addLocDiv").className = "panel panel-danger";
                        }
                    })
                        .fail(function() { alert("error"); })
                        .always(function() {
                        });
                }
            });
        });

        function validateDupe(field, msgOnFail, section){
            if(field === "" || field === null){
                document.getElementById('msg'+section).innerHTML = msgOnFail;
                document.getElementById("add"+section+"Div").className = "panel panel-danger";
                return false;
            }
            return true;
        }

        function validateCarForm(){
            var make = $('#makeincar').val();
            var location = $('#location').val();
            var car = "Car";

            document.getElementById('msgCar').innerHTML = "";

            if(!(validateDupe(make, "Please select a car make", car) && validateDupe(location,"Please select a location" , car))){
                return false;
            }
            document.getElementById("addCarDiv").className = "panel panel-primary";
            return true;
        }

        function validateLocationForm(){
            var name = $('#name').val();
            var number = $('#phoneNumber').val();
            var postcode = $('#postcode').val();
            var loc = "Loc";

            document.getElementById('msgLoc').innerHTML = "";

            if(!(validateDupe(name, "Please enter a location name", loc) && validateDupe(postcode,"Please enter the Post code of the location" , loc))){
                return false;
            }else if(!validateDupe(number, "Please enter a valid phone number", loc) || !number.match(/^\d+$/)){
                return false;
            }
            document.getElementById("addLocDiv").className = "panel panel-primary";
            return true;
        }

        function validateTypeForm(){
            var make = $('#make').val();
            var model = $('#model').val();
            var price = $('#price').val();
            var file_data = $('#fileToUpload').prop('files')[0];
//            console.log(file_data);
//            return false;
            var type = "Type";

            document.getElementById('msgType').innerHTML = "";

            if(!(validateDupe(make, "Please enter a car make", type) && validateDupe(model, "Please enter a car model", type) && validateDupe(price,"Please enter a Price for renting" , type))){
                return false;
            }
            document.getElementById("addTypeDiv").className = "panel panel-primary";
            return true;
        }

    </script>

    <div class="row">
        <div class="col-sm-4">
            <div id="addCarDiv" class="panel panel-primary">
                <div class="panel-heading">Add Car</div>
                <div class="panel-body">
                    <div id="msgCar"></div>
                    <form id="addCarForm" method="post">
                        <table class ="table">
                            <tr><td>Location:</td><td><select id="location" name = "location">
                                        <option value="" selected disabled>Please Select</option>
                                        <?php
                                        $locations = sqlgetLocation();
                                        while ($location = $locations->fetch_assoc()) {
                                            echo '<option value="'.$location['locationid'].'">'.$location['name'].' - '.$location['postcode'].'</option>';
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr><td>Make:</td><td><select id="makeincar" name = "make">
                                        <option value="" selected disabled>Please Select</option>
                                        <?php
                                        $carTypes = sqlGetCarsMakers();
                                        while ($type = $carTypes->fetch_assoc()) {
                                            echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr><td>Model:</td><td><select id="modelincar" name ="model">
                                        <option value="">Please Select</option>
                                    </select></td></tr>
                            <tr><td><input id="submitAddCar" type="submit" value="Add" class="btn btn-success"></td></tr>
                        </table>
                    </form>
                </div>
            </div></div>
        <div class="col-sm-4">
            <div id="addTypeDiv" class="panel panel-primary">
                <div class="panel-heading">Add CarType</div>
                <div class="panel-body">
                    <div id="msgType"></div>
                    <form id="addTypeForm" method="post" enctype="multipart/form-data">
                        <table class ="table">
                            <tr><td>Make:      </td><td><input type ="text" id="make" name="make">        </td></tr>
                            <tr><td>Model:        </td><td><input type ="text" id="model" name="model">          </td></tr>
                            <tr><td>Price Per Day:</td><td><input type ="number" id="price" name="price" min="0" step="0.01"></td></tr>
                            <tr><td>Car Image: </td><td><input type="file" name="fileToUpload" id="fileToUpload" required></td></tr>
                            <tr><td><input id="submitAddType" type="submit" value="Add" class="btn btn-success">         </td></tr>
                        </table>
                    </form>
                </div></div></div>
        <div class="col-sm-4">
            <div id="addLocDiv" class="panel panel-primary">
                <div class="panel-heading">Add Location</div>
                <div class="panel-body">
                    <div id="msgLoc"></div>
                    <form id="addLocForm" method="post">
                        <table class ="table">
                            <tr><td>Name:        </td><td><input type ="text" id="name" name="name">       </td></tr>
                            <tr><td>Phone Number:</td><td><input type ="text" id="phoneNumber" name="phoneNumber"></td></tr>
                            <tr><td>Post Code:   </td><td><input type ="text" id="postcode" name="postcode">   </td></tr>
                            <tr><td><input id="submitAddLoc" type="submit" value="Add" class="btn btn-success">    </td></tr>
                        </table>
                    </form>
                </div></div></div>
    </div>


<?php

include_once "dependencies/footer.php";