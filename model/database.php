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
//function populate()
//{
//
//    for ($i = 0; $i < 10; $i++) {
//        insertUser(randomStringWithoutNum(5), md5(randomString(10)), randomStringWithoutNum(8), randomString(12), randomInt(2));
//    }
//
//    for ($i = 0; $i < 10; $i++) {
//        insertCarType(randomString(7), randomString(5));
//    }
//
//
//    for ($i = 0; $i < 10; $i++) {
//        insertLocation(randomString(7), randomString(5), randomInt(5));
//    }
//
//    $carTypes = sqlgetTypeOfCars();
//    $locations = sqlgetLocation();
//    if ($carTypes->num_rows > 0) {
//        if ($locations->num_rows > 0) {
//            while ($type = $carTypes->fetch_assoc()) {
//                while ($location = $locations->fetch_assoc()) {
//                    insertCar($location["locationid"], $type["typeid"], randomString(100));
//                }
//            }
//        }
//    }
//    $cars = sqlgetCars();
//    $users = sqlgetUser();
//    if ($cars->num_rows > 0) {
//        while ($car = $cars->fetch_assoc()) {
//
//            if ($users->num_rows > 0) {
//                $user = $users->fetch_assoc();
//                insertReservation("10-11-11", "11-11-11", 1, $user["username"], $car["carid"]);
//
//            }
//        }
//    }
//}

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

function insertCarType($comp, $model, $price, $img)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `TypesOfCar` (`typeid`, `make`, `model`, `price`, `img`) VALUES (NULL, ?, ?, ?, ?)');
    $stmt->bind_param('ssis', $comp, $model, $price, $img);
    $stmt->execute();
    $stmt->close();
}

function insertCar($loc, $type)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `CarInstance` (`carid`, `location`, `type`) VALUES (NULL, ?, ?)');
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
    $outcome = $stmt->error;
    $stmt->close();
    return $outcome;
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
    global $conn;
    $stmt = $conn->prepare("SELECT ci.carid AS id, toc.make AS make, toc.model AS model, toc.img AS img, loc.name AS location FROM `CarInstance` AS ci JOIN TypesOfCar AS toc ON toc.typeid = ci.type JOIN Location AS loc ON ci.location = loc.locationid WHERE ci.location = ?");
    $stmt->bind_param('i', $location);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
//    $sql = "SELECT ci.carid AS id, toc.make AS make, toc.model AS model, loc.name AS location FROM `CarInstance` AS ci JOIN TypesOfCar AS toc ON toc.typeid = ci.type JOIN Location AS loc ON ci.location = loc.locationid WHERE ci.location = ".$location;
//    return sendQuery($sql);
}

function sqlCheckisRented($carID){
    global $conn;
    $stmt = $conn->prepare("SELECT res.username AS rentee FROM `CarInstance` AS ci JOIN Reservation AS res ON res.carid = ci.carid WHERE ci.carid = ? AND res.active = 1");
    $stmt->bind_param('i', $carID);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
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
    $sql = "SELECT ci.carid AS id, toc.make AS make, toc.model AS model, toc.img AS img, loc.name AS location FROM `CarInstance` AS ci JOIN TypesOfCar AS toc JOIN Location AS loc ON ci.location = loc.locationid WHERE toc.typeid = ci.type";
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
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND model = ? ORDER BY make, model");
    $stmt->bind_param('ss', $make, $model);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
//    $sql = "SELECT * FROM TypesOfCar WHERE make = '$make' AND model = '$model' ORDER BY make, model";
//    return sendQuery($sql);
}


function validateCarId($carId){
    //TODO this is an issue when element and value aren't strings
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `CarInstance` WHERE carid = ?");
    $stmt->bind_param('i', $carId);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return ($outcome > 0);
//    $sql = "SELECT * FROM `$table` WHERE `$element` = `$value`";
//    $req = sendQuery($sql);
//    return ($req->num_rows > 0);

}//TODO make this accept reality

function input($field){
    return (strip_tags((isset($_POST[$field]))?filter_var($_POST[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ));//TODO Make sql save as sqli need connection
}

function checkLogin($username, $password){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `User` WHERE `username` = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    if($outcome -> num_rows > 0){
        $reqq = $outcome -> fetch_assoc();
        $pass = $reqq["password"];
        if(md5($password) === $pass){
            return true;
        }
    }
    return false;
}

function addNewUser($username, $password){
    $users = sqlGetUsers();
    while($user = $users ->fetch_assoc()){
        if($user["username"] === $username){
            return false;
        }
    }
    $encPass = md5($password);
    global $conn;
    $stmt = $conn->prepare("INSERT INTO `User` (`username`, `password`, `name`, `type`) VALUES (?,?,'TIM', '0')");
    $success = $stmt->bind_param('ss', $username, $encPass);
    $stmt->execute();
    $stmt->close();
    return $success;
    }




function insertReservationByCar($location, $type, $username, $start, $end)
{
    $carId = sqlCheckValidDateForHire($location, $type, $start, $end);
    if( $carId != -1) {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO `Reservation` (`reservationid`, `startdate`, `enddate`, `active`, `username`, `carid`) VALUES (NULL, ?, ?, 1, ?, ?)');
        $stmt->bind_param('sssi', $start, $end, $username, $carId);
        $stmt->execute();
        $stmt->close();
        return true;
    } else {
        return false;
    }
}

function getInstancefromLocTyp($location, $type){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `CarInstance` WHERE location= ? AND type = ?");
    $stmt->bind_param('ii', $location,$type);
     $stmt->execute();
     $outcome = $stmt->get_result();
     $stmt->close();
    return $outcome;
}
function sqlCheckValidDateForHire($location, $type, $start, $end){
    $req = getInstancefromLocTyp($location, $type);
    if ($req->num_rows > 0) {
        while ($carID = $req->fetch_assoc()) {
            $car = $carID["carid"];
            $reqq = sqlgetReservationFromCarID($car);
            if ($reqq->num_rows > 0) {
                while($reservation = $reqq ->fetch_assoc()){
                    if(!(($start <= $reservation["enddate"] && $end >= $reservation["enddate"]) || ($start <= $reservation["startdate"] && $end >= $reservation["startdate"]) )){
                        return $carID["carid"];
                    }
                }
                //TODO write code to do this
            } else {
                return $carID["carid"];
            }
        }
    }
    return -1;
}

function sqlgetReservationFromCarID($carID)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `Reservation` WHERE carid = ? AND active = 1");
    $stmt->bind_param('i', $carID);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
//    $sql = "SELECT * FROM `Reservation` WHERE carid = $carID";
//    return sendQuery($sql);

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

function getUserRights($username){ // They have no rights they are just our slaves
    global $conn;
    $stmt = $conn->prepare("SELECT `type` FROM `User` WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    if($outcome->num_rows > 0){
        return ($outcome->fetch_assoc())["type"];
    } else {
        return -1;
    }
}

function getUserReservation($username){
    global $conn;
    $stmt = $conn->prepare("SELECT reservationid, startdate, enddate, model, make, name FROM `Reservation` AS r JOIN `CarInstance` AS ci JOIN `TypesOfCar` AS toc JOIN `Location` AS l ON r.carid = ci.carid AND ci.type = toc.typeid AND ci.location = l.locationid WHERE username =?  AND active = 1");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
}

function getAdminUserReservation($username){
    global $conn;
    $stmt = $conn->prepare("SELECT active, reservationid, username, startdate, enddate, model, make, name FROM `Reservation` AS r JOIN `CarInstance` AS ci JOIN `TypesOfCar` AS toc JOIN `Location` AS l ON r.carid = ci.carid AND ci.type = toc.typeid AND ci.location = l.locationid WHERE username =?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
}

function getAllReservations(){
    global $conn;
    $stmt = $conn->prepare("SELECT active, reservationid, username, startdate, enddate, model, make, name FROM `Reservation` AS r JOIN `CarInstance` AS ci JOIN `TypesOfCar` AS toc JOIN `Location` AS l ON r.carid = ci.carid AND ci.type = toc.typeid AND ci.location = l.locationid");
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;

}


function invalidateReservation($id){
    global $conn;
    $stmt = $conn->prepare('UPDATE `Reservation` SET active = 0 WHERE reservationid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

function sqlGetUsers(){
    global $conn;
    $sql = ("SELECT * FROM `User`");
    return sendQuery($sql);
}

function sqlGetCarsWithFilter($make,$model,$min,$max)
{
    global $conn;
    if ($make != null && $model != null) {
        if($min != null && $max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND model = ? AND price > ? AND price < ? ORDER BY make, model");
            $stmt->bind_param('ssii', $make, $model, $min, $max);
        } else if($min != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND model = ? AND price > ? ORDER BY make, model ");
            $stmt->bind_param('ssi', $make, $model, $min);
        } else if($max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND model = ? AND  price < ? ORDER BY make, model");
            $stmt->bind_param('ssi', $make, $model, $max);
        } else {
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND model = ? ORDER BY make, model");
            $stmt->bind_param('ss', $make, $model);
        }
    } else if ($make != null) {
        if($min != null && $max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND price > ? AND price < ? ORDER BY make, model");
            $stmt->bind_param('sii', $make, $min, $max);
        } else if($min != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND price > ? ORDER BY make, model");
            $stmt->bind_param('si', $make, $min);
        } else if($max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE make = ? AND price < ? ORDER BY make, model");
            $stmt->bind_param('si', $make, $max);
        } else {
            $stmt = $conn->prepare("SELECT * FROM `TypesOfCar` WHERE make = ? ORDER BY make, model");
            $stmt->bind_param('s', $make);
        }
    } else {
        if($min != null && $max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE price > ? AND price < ? ORDER BY make, model");
            $stmt->bind_param('ii', $min, $max);
        } else if($min != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE price > ? ORDER BY make, model");
            $stmt->bind_param('i',  $min);
        } else if($max != null){
            $stmt = $conn->prepare("SELECT * FROM TypesOfCar WHERE price < ? ORDER BY make, model");
            $stmt->bind_param('i', $max);
        } else {
            $sql = "SELECT * FROM `TypesOfCar` ORDER BY make, model";
            return sendQuery($sql);
        }
    }
    $stmt->execute();
    $outcome = $stmt->get_result();
    $stmt->close();
    return $outcome;
}

