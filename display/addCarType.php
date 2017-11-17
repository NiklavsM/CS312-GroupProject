<?php
include_once "dependencies/header.php";



?>

<form method="post" action="~/../model/addCarTypeHandler.php">
    <input type ="text" name="company">
    <input type ="text" name="model">
    <input type ="number" name="price" min="0">
    <input type="submit" value="Add" class="btn btn-success">
</form>

<?php
include_once "dependencies/footer.php";
?>
