<?php
include_once "database.php";
$username = input("loginUsernameValue");
if($username != "") {
    $retuned = sqlGetPossibleUser($username);
    if ($retuned->num_rows > 0) {
        echo "true";
    }
}
