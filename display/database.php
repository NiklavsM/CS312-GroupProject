<?php

if(count(get_included_files()) ==1) exit("Direct access not permitted.");

$host = "devweb2017.cis.strath.ac.uk";
$user = "cs312_o";
$pass = "Bae3be6OoD7V";
$dbname = "cs312_o";
$conn = new mysqli($host, $user, $pass, $dbname);


