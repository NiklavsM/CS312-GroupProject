<?php
include_once "dependencies/header.php";
?>

<form method="post" action="~/../model/addNewHubLocationHandler.php">
    <input type ="text" name="name">
    <input type ="text" name="phoneNumber">
    <input type ="text" name="postcode">
    <input type="submit" value="Add" class="btn btn-success">
</form>

<?php
include_once "dependencies/footer.php";
?>
