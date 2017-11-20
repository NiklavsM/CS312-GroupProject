<?php

if(count(get_included_files()) ==1) exit("Direct access not permitted.");
$host = "devweb2017.cis.strath.ac.uk";
$user = "cs312_o";
$pass = "Bae3be6OoD7V";
$dbname = "cs312_o";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    //TODO something on error
}
function populate()
{

    for ($i = 0; $i < 10; $i++) {
        insertUser(randomStringWithoutNum(5), md5(randomString(10)), randomStringWithoutNum(8), randomString(12), randomInt(2));
    }

    for ($i = 0; $i < 10; $i++) {
        insertCarType(randomString(7), randomString(5));
    }


    for ($i = 0; $i < 10; $i++) {
        insertLocation(randomString(7), randomString(5), randomInt(5));
    }

    $carTypes = sqlgetTypeOfCars();
    $locations = sqlgetLocation();
    if ($carTypes->num_rows > 0) {
        if ($locations->num_rows > 0) {
            while ($type = $carTypes->fetch_assoc()) {
                while ($location = $locations->fetch_assoc()) {
                    insertCar($location["locationid"], $type["typeid"], randomString(100));
                }
            }
        }
    }
    $cars = sqlgetCars();
    $users = sqlgetUser();
    if ($cars->num_rows > 0) {
        while ($car = $cars->fetch_assoc()) {

            if ($users->num_rows > 0) {
                $user = $users->fetch_assoc();
                insertReservation("10-11-11", "11-11-11", 1, $user["username"], $car["carid"]);

            }
        }
    }
}

function randomStringWithoutNum($size)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    return randomCharGen($size, $characters);
}

function randomString($size)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    return randomCharGen($size, $characters);
}

function randomInt($size)
{
    $characters = '0123456789';
    return randomCharGen($size, $characters);
}

function randomCharGen($size, $chars)
{
    $charsLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < $size; $i++) {
        $randomString .= $chars[rand(0, $charsLength - 1)];
    }
    return $randomString;
}

function insertUser($uName, $pass, $name, $dln, $type)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `User` (`username`, `password`, `name`, `dln`, `type`) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssi', $uName, $pass, $name, $dln, $type);
    $stmt->execute();
    $stmt->close();
}

function insertCarType($comp, $model, $price)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `TypesOfCar` (`typeid`, `make`, `model`, `price`) VALUES (NULL, ?, ?, ?)');
    $stmt->bind_param('ssi', $comp, $model, $price);
    $stmt->execute();
    $stmt->close();
}

function insertCar($loc, $type)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `CarInstance` (`carid`, `location`, `type`, `img`) VALUES (NULL, ?, ?, NULL)');
    $stmt->bind_param('ii', $loc, $type);
    $stmt->execute();
    $stmt->close();
}

function insertReservation($start, $end, $active, $username, $carId)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `Reservation` (`reservationid`, `startdate`, `enddate`, `active`, `username`, `carid`) VALUES (NULL, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssisi', $start, $end, $active, $username, $carId);
    $stmt->execute();
    $stmt->close();
}

function insertLocation($name, $postc, $phonenumber)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `Location` (`locationid`,`name`, `postcode`, `phonenumber`) VALUES (NULL, ?, ?, ?)');
    $stmt->bind_param('sss', $name, $postc, $phonenumber);
    $stmt->execute();
    $stmt->close();
}

function changeLocationOfCar($carid, $location)
{
    global $conn;
    $stmt = $conn->prepare('UPDATE `CarInstance` SET location = ? WHERE carid = ?');
    $stmt->bind_param('ii', $location, $carid);
    $stmt->execute();
    $stmt->close();
}

function sqlgetCarsAtLocation($location){
    $sql = "SELECT ci.carid AS id, toc.make AS make, toc.model AS model, loc.name AS location FROM `CarInstance` AS ci JOIN TypesOfCar AS toc ON toc.typeid = ci.type JOIN Location AS loc ON ci.location = loc.locationid WHERE ci.location = ".$location;
    return sendQuery($sql);
}

function sqlCheckisRented($carID){
    $sql = "SELECT res.username AS rentee FROM `CarInstance` AS ci JOIN Reservation AS res ON res.carid = ci.carid WHERE ci.carid = ".$carID;
    return sendQuery($sql);
}

function removeCarById($carid){
    global $conn;
    $stmt = $conn->prepare('DELETE FROM `CarInstance` WHERE carid = ?');
    $stmt->bind_param('i', $carid);
    $stmt->execute();
    $stmt->close();
}

function removeAllElements()
{
    $sql = "TRUNCATE TABLE `Reservation`";
    sendQuery($sql);
    $sql = "TRUNCATE TABLE `Cars`";
    sendQuery($sql);
    $sql = "TRUNCATE TABLE `User`";
    sendQuery($sql);
    $sql = "TRUNCATE TABLE `Location`";
    sendQuery($sql);
    $sql = "TRUNCATE TABLE `TypesOfCar`";
    sendQuery($sql);
}

function sqlgetTypeOfCars()
{
    $sql = "SELECT * FROM `TypesOfCar`";
    return sendQuery($sql);
}

function sqlgetLocation()
{
    $sql = "SELECT * FROM `Location`";
    return sendQuery($sql);
}

function sqlgetCars()
{
    $sql = "SELECT * FROM `CarInstance`";
    return sendQuery($sql);
}

function sqlgetCarTypes()
{
    $sql = "SELECT ci.carid AS id, toc.make AS make, toc.model AS model, loc.name AS location FROM `CarInstance` AS ci JOIN TypesOfCar AS toc JOIN Location AS loc ON ci.location = loc.locationid WHERE toc.typeid = ci.type";
    return sendQuery($sql);
}

function sqlgetUser()
{
    $sql = "SELECT * FROM `User`";
    return sendQuery($sql);

}

function sqlGetCarsMakers(){
    $sql = "SELECT make FROM `TypesOfCar` GROUP BY make";
    return sendQuery($sql);
}

function sqlgetReservation()
{
    $sql = "SELECT * FROM `Reservation`";
    return sendQuery($sql);

}

function getTypeFromMakeAndModel($make,$model){
    $sql = "SELECT * FROM TypesOfCar WHERE make = '$make' AND model = '$model' ORDER BY make, model";
    return sendQuery($sql);
}

function sqlGetCarsWithFilter($make,$model){
    if($make != null && $model != null) {
        $sql = "SELECT * FROM TypesOfCar WHERE make = '$make' AND model = '$model' ORDER BY make, model";
        return sendQuery($sql);
    }
    if($make != null){
        $sql = "SELECT * FROM `TypesOfCar` WHERE make = '$make' ORDER BY make, model";
        return sendQuery($sql);
    }
    $sql = "SELECT * FROM `TypesOfCar` ORDER BY make, model";
    return sendQuery($sql);
}

function validate($table,$element, $value){
    $sql = "SELECT * FROM `$table` WHERE `$element` = `$value`";
    $req = sendQuery($sql);
    return ($req->num_rows > 0);

}//TODO make this accept reality

function input($field){
    return (strip_tags((isset($_POST[$field]))?filter_var($_POST[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ));//TODO Make sql save as sqli need connection
}

function checkLogin($username, $password){
    $sql = "SELECT * FROM `User` WHERE `username` = '$username'";
    $req = sendQuery($sql);
    if($req -> num_rows > 0){
        $reqq = $req -> fetch_assoc();
        $pass = $reqq["password"];
        if(md5($password) === $pass){
            return true;
        }
    }
    return false;
}

function addNewUser($username, $password, $dln, $name){
    $encPass = md5($password);
    global $conn;
    $stmt = $conn->prepare($sql = "INSERT INTO `User` (`username`, `password`, `name`, `dln`, `type`) VALUES (?,?,?,?, '0')");
    $stmt->bind_param('ssss', $username, $encPass, $name, $dln);
    $outcome = $stmt->execute();
    $stmt->close();
    return $outcome;
    }


function sendQuery($query)
{
    global $conn;
    $result = $conn->query($query);
    if ($conn->connect_error) {
        return $conn->error;
    }
    return $result;
}


