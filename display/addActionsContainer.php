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
            $('#make').on('change',function() {
                //get current selected item from carMaker
                var f = $('#make').val();
                //send f to dropDownHandler
                $.ajax({
                    url: '~/../../model/dropDownHandler.php',
                    type: 'post',
                    data: {'maker': f, 'addCar':"true"}
                }).done(function(msg) {
                    //insert html into selection
                    document.getElementById('model').innerHTML = msg;
                })
                    .fail(function() { alert("error"); })
                    .always(function() {
                    });
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

        function validateCarForm(event){
            var make = $('#makeincar').val();
            var location = $('#location').val();
            var car = "Car";

            document.getElementById('msgCar').innerHTML = "";

            if(!(validateDupe(make, "Please select a car make", car) && validateDupe(location,"Please select a location" , car))){
                event.preventDefault();
                return false;
            }
            document.getElementById("addCarDiv").className = "panel panel-primary";
            return true;
        }

        function validateLocationForm(event){
            var name = $('#name').val();
            var number = $('#phoneNumber').val();
            var postcode = $('#postcode').val();
            var loc = "Loc";

            document.getElementById('msgLoc').innerHTML = "";

            if(!(validateDupe(name, "Please enter a location name", loc) && validateDupe(postcode,"Please enter the Post code of the location" , loc))){
                event.preventDefault();
                return false;
            }else if(!validateDupe(number, "Please enter a valid phone number", loc) || !number.match(/^\d+$/)){
                event.preventDefault();
                return false;
            }
            document.getElementById("addLocDiv").className = "panel panel-primary";
            return true;
        }

        function validateTypeForm(event){
            var make = $('#make').val();
            var model = $('#model').val();
            var price = $('#price').val();
            var type = "Type";

            document.getElementById('msgType').innerHTML = "";

            if(!(validateDupe(make, "Please enter a car make", type) && validateDupe(model, "Please enter a car model", type) && validateDupe(price,"Please enter a Price for renting" , type))){
                event.preventDefault();
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
                    <form method="post" action="~/../../model/addCarInstanceHandler.php" onsubmit="validateCarForm(event)">
                        <table>
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
                            <tr><td><input type="submit" value="Add" class="btn btn-success"></td></tr>
                        </table>
                    </form></div>
            </div></div>
        <div class="col-sm-4">
            <div id="addTypeDiv" class="panel panel-primary">
                <div class="panel-heading">Add CarType</div>
                <div class="panel-body">
                    <div id="msgType"></div>
                    <form method="post" action="~/../../model/addCarTypeHandler.php" onsubmit="validateTypeForm(event)">
                        <table>
                            <tr><td>Make:      </td><td><input type ="text" id="make" name="make">        </td></tr>
                            <tr><td>Model:        </td><td><input type ="text" id="model" name="model">          </td></tr>
                            <tr><td>Price Per Day:</td><td><input type ="number" id="price" name="price" min="0" step="0.01"></td></tr>
                            <tr><td><input type="submit" value="Add" class="btn btn-success">         </td></tr>
                        </table>
                    </form></div></div></div>
        <div class="col-sm-4">
            <div id="addLocDiv" class="panel panel-primary">
                <div class="panel-heading">Add Location</div>
                <div class="panel-body">
                    <div id="msgLoc"></div>
                    <form method="post" action="~/../../model/addNewHubLocationHandler.php" onsubmit="validateLocationForm(event)">
                        <table>
                            <tr><td>Name:        </td><td><input type ="text" id="name" name="name">       </td></tr>
                            <tr><td>Phone Number:</td><td><input type ="text" id="phoneNumber" name="phoneNumber"></td></tr>
                            <tr><td>Post Code:   </td><td><input type ="text" id="postcode" name="postcode">   </td></tr>
                            <tr><td><input type="submit" value="Add" class="btn btn-success">    </td></tr>
                        </table>
                    </form></div></div></div>
    </div>


<?php

include_once "dependencies/footer.php";
