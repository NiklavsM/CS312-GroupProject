<?php
include_once "dependencies/header.php";
?>
<script>
    $(function(){
        $('#carMaker').on('change',function() {
            //get current selected item from carMaker
            var f = $('#carMaker').val();
            //send f to dropDownHandler
            $.ajax({
                url: '~/../../model/dropDownHandler.php',
                type: 'post',
                data: {'maker': f, 'addCar':"true"}
            }).done(function(msg) {
                //insert html into selection
                document.getElementById('carModel').innerHTML = msg;
            })
                .fail(function() { alert("error"); })
                .always(function() {
                });
        });
    });

    function validateForm(event){
        var make = $('#carMaker').val();
        var location = $('#location').val();
        if(make === "NA" || make === null){
            document.getElementById('msg').innerHTML = "Please select a car make";
            console.log(make + " " + location +  "return false");
            event.preventDefault();
            return false;
        }
        if(location === "NA" || location === null){
            document.getElementById('msg').innerHTML = "Please select a location";
            console.log(make + " " + location +  "return false");
            event.preventDefault();
            return false;
        }
        console.log(make + " " + location +  "return true");
        return true;
    }

</script>
    <div id="msg"></div>
    <form method="post" action="~/../../model/addCarInstanceHandler.php" onsubmit="validateForm(event)">
        <table>
            <tr><td>Registration Number:</td><td><input type ="text" name="carRegNr"></td></tr>
            <tr><td>Location:</td><td><select id="location" name = "location">
                        <option value="NA" selected disabled>Please Select</option>
                        <?php
                        $locations = sqlgetLocation();
                        while ($location = $locations->fetch_assoc()) {
                            echo '<option value='.$location['locationid'].'>'.$location['name'].' - '.$location['postcode'].'</option>';
                        }
                        ?>
                    </select></td></tr>
            <tr><td>Make:</td><td><select id="carMaker" name = "carMaker">
                        <option value="NA" selected disabled>Please Select</option>
                        <?php
                        $carTypes = sqlGetCarsMakers();
                        while ($type = $carTypes->fetch_assoc()) {
                            echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
                        }
                        ?>
                    </select></td></tr>
            <tr><td>Model:</td><td><select id="carModel" name ="carModel">
                                    <option value="NA">Please Select</option>
                    </select></td></tr>
            <tr><td><input type="submit" value="Add" class="btn btn-success"></td></tr>
        </table>
    </form>
<?php
include_once "dependencies/footer.php";
?>
