<?php
include_once "dependencies/header.php";

if(isset($_POST['error'])){
    echo "ERROR: ".$_POST['error'];
}else if(isset($_POST['success'])){
    echo "SUCCESS: ".$_POST['success'];
}else{
    echo "first visit";
}
?>

<form method="post" action="~/../../model/addCarTypeHandler.php">
    <table>
        <tr><td>Make:      </td><td><input type ="text" name="make">        </td></tr>
        <tr><td>Model:        </td><td><input type ="text" name="model">          </td></tr>
        <tr><td>Price Per Day:</td><td><input type ="number" name="price" min="0"></td></tr>
        <tr><td><input type="submit" value="Add" class="btn btn-success">         </td></tr>
    </table>
</form>

<?php
include_once "dependencies/footer.php";
?>
