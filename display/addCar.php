<?php
include_once "dependencies/header.php";
?>

<form method="post">
    <input type ="text" name="carRegNr">
    <select name = "carMaker">
        <option value="BMW">BMW</option>
        <option value="Audi">Audi</option>
        <option value="Merc">Merc</option>
    </select>
    <input type="submit" value="Add" class="btn btn-success">
</form>

<?php
include_once "dependencies/footer.php";
?>
