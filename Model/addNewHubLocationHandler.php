<?php
include_once "database.php";

$name        = input("name");
$postc       = input("postcode");
$phonenumber = input("phoneNumber");
?>
<form id="response" action="~/../../display/addLocation.php" method="post">
<?php
if($name === "" || $phonenumber === "" || $postc === ""){
    echo '<input type="hidden" name="error" value="field empty">';
    //TODO not allow invalid input response
} else if(!is_numeric($phonenumber)){
    echo '<input type="hidden" name="error" value="phone number must only contain numbers">';
    //TODO is numeric
} else {
    insertLocation($name, $postc, $phonenumber);
    echo '<input type="hidden" name="success" value="yay">';
}
?>
</form>
<script type="text/javascript">
    document.getElementById('response').submit();
</script>
