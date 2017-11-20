<?php
include_once "dependencies/header.php";

//if(isset($_POST['error'])){
//    echo "ERROR: ".$_POST['error'];
//}else if(isset($_POST['success'])){
//    echo "SUCCESS: ".$_POST['success'];
//}else{
//    echo "first visit";
//}
?>

<script>
    function validateForm(event){
        var make = $('#make').val();
        var model = $('#model').val();
        var price = $('#price').val();

        if(make === "" || make === null){
            document.getElementById('msgType').innerHTML = "Please enter a car make";
            event.preventDefault();
            return false;
        }
        if(model === "" || location === null){
            document.getElementById('msgType').innerHTML = "Please enter a car model";
            event.preventDefault();
            return false;
        }
        if(price === ""){
            document.getElementById('msgType').innerHTML = "Please enter a Price for renting";
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
<div id="msgType"></div>
<form method="post" action="~/../../model/addCarTypeHandler.php" onsubmit="validateForm(event)">
    <table>
        <tr><td>Make:      </td><td><input type ="text" id="make" name="make">        </td></tr>
        <tr><td>Model:        </td><td><input type ="text" id="model" name="model">          </td></tr>
        <tr><td>Price Per Day:</td><td><input type ="number" id="price" name="price" min="0" step="0.01"></td></tr>
        <tr><td><input type="submit" value="Add" class="btn btn-success">         </td></tr>
    </table>
</form>

<?php
include_once "dependencies/footer.php";
?>
