<?php

//if(count(get_included_files()) ==1) exit("Direct access not permitted.");
$host = "devweb2017.cis.strath.ac.uk";
$user = "cs312_o";
$pass = "Bae3be6OoD7V";
$dbname = "cs312_o";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    //TODO something on error
}
removeAllElements();
populate();

function populate()
{

    for ($i = 0; $i < 10; $i++) {
        insertUser(randomStringWithoutNum(5), md5(randomString(10)), randomStringWithoutNum(8), randomString(12), randomInt(2));
    }

    for ($i = 0; $i < 10; $i++) {
        insertCarType(randomString(7), randomString(5), randomString(5));
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
                    insertCar($location["id"], $type["id"], randomString(100));
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
                insertReservation("10-11-11", "11-11-11", 1, $user["username"], $car["id"]);

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

function insertUser($uName, $pass, $name, $dLN, $type)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `User` (`username`, `password`, `name`, `dLN`, `type`) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssi', $uName, $pass, $name, $dLN, $type);
    $stmt->execute();
    $stmt->close();
}

function insertCarType($comp, $model, $colour)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `TypesOfCars` (`id`, `company`, `model`, `colour`) VALUES (NULL, ?, ?, ?)');
    $stmt->bind_param('sss', $comp, $model, $colour);
    $stmt->execute();
    $stmt->close();
}

function insertCar($loc, $type, $img)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `Cars` (`id`, `location`, `type`, `img`) VALUES (NULL, ?, ?, ?)');
    $stmt->bind_param('iis', $loc, $type, $img);
    $stmt->execute();
    $stmt->close();
}

function insertReservation($start, $end, $active, $uname, $carId)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `Reservation` (`id`, `startDate`, `endDate`, `active`, `username`, `carId`) VALUES (NULL, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssisi', $start, $end, $active, $uname, $carId);
    $stmt->execute();
    $stmt->close();
}

function insertLocation($name, $postc, $pnumber)
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO `Location` (`id`,`name`, `postcode`, `pnumber`) VALUES (NULL, ?, ?, ?)');
    $stmt->bind_param('ssi', $name, $postc, $pnumber);
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
    $sql = "TRUNCATE TABLE `TypesOfCars`";
    sendQuery($sql);
}

function sqlgetTypeOfCars()
{
    $sql = "SELECT * FROM `TypesOfCars`";
    return sendQuery($sql);
}

function sqlgetLocation()
{
    $sql = "SELECT * FROM `Location`";
    return sendQuery($sql);
}

function sqlgetCars()
{
    $sql = "SELECT * FROM `Cars`";
    return sendQuery($sql);
}

function sqlgetUser()
{
    $sql = "SELECT * FROM `User`";
    return sendQuery($sql);

}


//function used locally to check if a game exists between the two players
function isGame($p1id, $p2id)
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM `scoretracker` WHERE (`p1id`=? AND `p2id`=?) OR (`p1id`=? AND `p2id`=?)');
    $stmt->bind_param('iiii', $p1id, $p2id, $p2id, $p1id);
    $stmt->execute();
    $affected = $stmt->get_result()->num_rows;
    $stmt->close();
    return $affected > 0;
}

//new score that requires a match between the two players to exist (cannot update the score of a match that already have scores)
function newScore($p1id, $p1score, $p2score, $p2id)
{
    global $conn;
    $p1id = sqlSafe($p1id);
    $p2id = sqlSafe($p2id);
    $p1score = sqlSafe($p1score);
    $p2score = sqlSafe($p2score);

    if (isGame($p1id, $p2id)) {
        $stmt = $conn->prepare('UPDATE `scoretracker` SET `p1score`=?, `p2score`=?, `playingnow`=0 WHERE `p1id`=? AND `p2id`=? AND `p1score` IS NULL AND `p2score` IS NULL');
        $stmt->bind_param('iiii', $p1score, $p2score, $p1id, $p2id);
        $stmt->execute();
        $affected = $conn->affected_rows;
        if ($affected == 0) {
            $stmt->close();
            $stmt = $conn->prepare('UPDATE `scoretracker` SET `p1score`=?, `p2score`=?, `playingnow`=0 WHERE `p1id`=? AND `p2id`=? AND `p1score` IS NULL AND `p2score` IS NULL');
            $stmt->bind_param('iiii', $p2score, $p1score, $p2id, $p1id);
            $stmt->execute();
            $affected = $conn->affected_rows;
            if ($affected == 0) {
                ?>
                <script>
                    displayErrorMessage("Game has already been played, edit played games scores in the results section.");
                </script>
                <?php
            }
        }
        $stmt->close();
    } else {
        ?>
        <script>
            displayErrorMessage("Make sure that there is already a fixture between these players");
        </script>
        <?php
    }
}

//updates score between the two players
function updateScore($p1id, $p1score, $p2score, $p2id)
{
    global $conn;
    $p1id = sqlSafe($p1id);
    $p2id = sqlSafe($p2id);
    $p1score = sqlSafe($p1score);
    $p2score = sqlSafe($p2score);

    $stmt = $conn->prepare('UPDATE `scoretracker` SET `p1score`=?, `p2score`=?, `playingnow`=0 WHERE `p1id`=? AND `p2id`=?');
    $stmt->bind_param('iiii', $p1score, $p2score, $p1id, $p2id);

    $stmt->execute();
    $affected = $conn->affected_rows;
    if ($affected == 0) {
        $stmt->close();
        $stmt = $conn->prepare('UPDATE `scoretracker` SET `p1score`=?, `p2score`=?, `playingnow`=0 WHERE `p1id`=? AND `p2id`=?');
        $stmt->bind_param('iiii', $p2score, $p1score, $p2id, $p1id);
        $stmt->execute();
    }
    $stmt->close();
}

// ------------------ DB GET ----------------------//

function sqlGamesPlayed()
{
    $sql = "SELECT t1.id AS p1id, t1.name AS name1, s.p1score, s.p2score, t2.name AS name2, s.id, t2.id AS p2id FROM `scoretracker` AS s INNER JOIN `tennistournament` AS t1 ON t1.id = s.p1id INNER JOIN `tennistournament` AS t2 ON t2.id = s.p2id WHERE s.p1score >=0 AND s.p2score >= 0";
    return sendQuery($sql);
}

function sqlUsers()
{
    $sql = "SELECT * FROM `tennistournament`";
    return sendQuery($sql);
}

function sqlGameFixtures()
{
    $sql = "SELECT t1.name AS name1, t2.name AS name2, p1id, p2id FROM `scoretracker` AS s INNER JOIN `tennistournament` AS t1 ON t1.id = s.p1id INNER JOIN `tennistournament` AS t2 ON t2.id = s.p2id WHERE s.p1score IS NULL AND s.p2score IS NULL AND s.playingnow=0";
    return sendQuery($sql);
}

function sqlCurrentlyPlaying()
{
    $sql = "SELECT s.p1id, s.p2id, t1.name AS name1, t2.name AS name2 FROM `scoretracker` AS s INNER JOIN `tennistournament` AS t1 ON t1.id = s.p1id INNER JOIN `tennistournament` AS t2 ON t2.id = s.p2id WHERE s.p1score IS NULL AND s.p2score IS NULL AND s.playingnow = 1";
    return sendQuery($sql);
}

function sqlCoachPW()
{
    $sql = "SELECT * FROM `coachlogin`";
    return sendQuery($sql);
}


function sqlLeagueRanks()
{
    $sql = "SELECT\n"
        . " t.name AS name,\n"
        . " COUNT(\n"
        . " CASE WHEN t.id = s.p1id AND s.p1score > s.p2score THEN 1 WHEN t.id = s.p2id AND s.p2score > s.p1score THEN 1\n"
        . " END\n"
        . ") AS wins\n"
        . "FROM\n"
        . " `scoretracker` AS s\n"
        . "JOIN\n"
        . " `tennistournament` AS t ON t.id = s.p1id OR t.id = s.p2id\n"
        . "GROUP BY t.id\n"
        . "ORDER BY\n"
        . " wins DESC, name";

    return sendQuery($sql);
}

function getDBPW()
{
    $sql = "SELECT passw FROM `coachlogin` WHERE id =1";
    return sendQuery($sql);
}

function sqlSafe($field)
{
    global $conn;
    return $conn->real_escape_string($field);
}

function sendQuery($query)
{
    global $conn;
    $result = $conn->query($query);
    if ($conn->connect_error) {
        ?>
        <script>
            displayErrorMessage("Connection Error");
        </script>
        <?php
    }
    return $result;
}


