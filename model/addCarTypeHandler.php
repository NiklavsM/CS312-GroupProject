<?php

include_once "database.php";

$comp  = input("company");
$model = input("model");

?>
<form id="response" action="~/../../display/addCarType.php" method="post">
<?php
if($comp === "" || $model === ""){
    echo '<input type="hidden" name="error" value="field empty">';
} else {
    insertCarType($comp, $model);
    echo '<input type="hidden" name="success" value="success">';
}
?>
</form>
<script type="text/javascript">
    document.getElementById('response').submit();
</script>
