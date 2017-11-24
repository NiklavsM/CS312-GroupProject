<?php

include_once "database.php";

$comp  = input("make");
$model = input("model");
$price = input("price");

?>
<form id="response" action="~/../../display/addCarType.php" method="post">
<?php

if($comp !== "" && $model !== "" && $price !== ""){
    insertCarType($comp, $model,$price);
}

?>
</form>
<!--<script type="text/javascript">-->
<!--    document.getElementById('response').submit();-->
<!--</script>-->
