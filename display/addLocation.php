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
        var name = $('#name').val();
        var number = $('#phoneNumber').val();
        var postcode = $('#postcode').val();
        console.log("Got: " + name + ":" + postcode  + ":" + number);
        if(name === "" || name === null){
            document.getElementById('msgloc').innerHTML = "Please enter a location name";
            console.log("name not valid: " + name);
            event.preventDefault();
            return false;
        }
        if(number === "" || number === null || !number.match(/^\d+$/)){
            document.getElementById('msgloc').innerHTML = "Please enter a valid phone number";
            console.log("number not valid: " + number);
            event.preventDefault();
            return false;
        }
        if(postcode === "" || postcode === null){
            document.getElementById('msgloc').innerHTML = "Please enter the Post code of the location";
            console.log("postcode not valid: " + postcode);
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
<div id="msgloc"></div>
<form method="post" action="~/../../model/addNewHubLocationHandler.php" onsubmit="validateForm(event)">
    <table>
        <tr><td>Name:        </td><td><input type ="text" id="name" name="name">       </td></tr>
        <tr><td>Phone Number:</td><td><input type ="text" id="phoneNumber" name="phoneNumber"></td></tr>
        <tr><td>Post Code:   </td><td><input type ="text" id="postcode" name="postcode">   </td></tr>
        <tr><td><input type="submit" value="Add" class="btn btn-success">    </td></tr>
    </table>
</form>

<?php
include_once "dependencies/footer.php";
?>
