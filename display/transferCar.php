<?php
include_once "~../../../model/database.php";


$carid    = input("id");
$location   = input("transfer");

if(isset($_POST['delete'])){
    removeCarById($carid);
}else{
    changeLocationOfCar($carid, $location);
}
?>
