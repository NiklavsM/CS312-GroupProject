<?php
include_once "dependencies/header.php";

if(isset($_POST['response'])){
    echo $_POST['response'];
}else{
    echo "false";
}
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

    function validateForm(event){
        var make = $('#make').val();
        var location = $('#location').val();
        if(make === "NA" || make === null){
            document.getElementById('msgCar').innerHTML = "Please select a car make";
            console.log(make + " " + location +  "return false");
            event.preventDefault();
            return false;
        }
        if(location === "NA" || location === null){
            document.getElementById('msgCar').innerHTML = "Please select a location";
            console.log(make + " " + location +  "return false");
            event.preventDefault();
            return false;
        }
        console.log(make + " " + location +  "return true");
        return true;
    }

</script>
    <div id="msgCar"></div>
    <form method="post" action="~/../../model/addCarInstanceHandler.php" onsubmit="validateForm(event)">
        <table>
            <tr><td>Location:</td><td><select id="location" name = "location">
                        <option value="NA" selected disabled>Please Select</option>
                        <?php
                        $locations = sqlgetLocation();
                        while ($location = $locations->fetch_assoc()) {
                            echo '<option value='.$location['locationid'].'>'.$location['name'].' - '.$location['postcode'].'</option>';
                        }
                        ?>
                    </select></td></tr>
            <tr><td>Make:</td><td><select id="make" name = "make">
                        <option value="NA" selected disabled>Please Select</option>
                        <?php
                        $carTypes = sqlGetCarsMakers();
                        while ($type = $carTypes->fetch_assoc()) {
                            echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
                        }
                        ?>
                    </select></td></tr>
            <tr><td>Model:</td><td><select id="model" name ="model">
                                    <option value="NA">Please Select</option>
                    </select></td></tr>
            <tr><td><input type="submit" value="Add" class="btn btn-success"></td></tr>
        </table>
    </form>
<?php
include_once "dependencies/footer.php";
?>
