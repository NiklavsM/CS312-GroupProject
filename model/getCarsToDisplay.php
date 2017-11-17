<?php
$maker = input("maker");
$model = input("model");

$result = sqlGetCarswithFilter($maker,$model);
