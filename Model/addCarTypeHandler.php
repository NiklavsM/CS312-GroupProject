<?php
$comp  = input("company");
$model = input("model");

if($comp === "" || $model === ""){

} else {
    insertCarType($comp, $model);
}
