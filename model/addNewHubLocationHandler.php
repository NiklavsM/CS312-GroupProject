<?php
include_once "database.php";

$name        = input("name");
$postc       = input("postcode");
$phonenumber = input("phoneNumber");

?>
    <form id="response" action="~/../../display/addLocation.php" method="post">
<?php

if($name !== "" && $phonenumber !== "" && $postc !== "") {
    insertLocation($name, $postc, $phonenumber);
}
?>
</form>
<!--<script type="text/javascript">-->
<!--    document.getElementById('response').submit();-->
<!--</script>-->
