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

<form method="post" action="~/../../model/addNewHubLocationHandler.php">
    <table>
        <tr><td>Name:        </td><td><input type ="text" name="name">       </td></tr>
        <tr><td>Phone Number:</td><td><input type ="text" name="phoneNumber"></td></tr>
        <tr><td>Post Code:   </td><td><input type ="text" name="postcode">   </td></tr>
        <tr><td><input type="submit" value="Add" class="btn btn-success">    </td></tr>
    </table>
</form>

<?php
include_once "dependencies/footer.php";
?>
