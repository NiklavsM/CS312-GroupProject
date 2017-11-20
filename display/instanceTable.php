<?php
include_once "~../../../model/database.php";
?>

<script>
    function handleDelete(){

    }
</script>
<?php

$locationID= input("location");
//echo $location;
$result = sqlgetCarsAtLocation($locationID);
if($locationID === "NA"){
    $result = sqlgetCarTypes();
}
if ($result->num_rows > 0) {
    $resultArray = array();
    while ($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }
}
if (isset($resultArray)) {
    ?>
    <table name="Table" class ="table">
        </tr>
        <th></th>
        <th>Make</th>
        <th>Model</th>
        <th></th>
        <?php
        if($locationID === "NA"){
            ?>
            <th>Location</th>
            <?php
        }
        ?>
        <th>Rented By</th>
        <th>Transfer</th>
        <th>Send To</th>
        <tr>
            <?php
            foreach ($resultArray as $row) {
                $rentingResult = sqlCheckisRented($row['id']);
                $rented = $rentingResult->fetch_assoc();
                echo '</tr>';
                echo '<td><button class="btn btn-info" onclick="handleDelete()">Delete</button></td>';
                echo '<td>' . $row["make"] . '</td>';
                echo '<td>' . $row["model"] . '</td>';
                echo '<td><img src="../img/GoodCar.jpg" alt="Luxury at its finest" height="90" width="90"></td>';
                if($locationID === "NA"){
                    echo '<td>' . $row["location"] . '</td>';
                }
                if(isset($rented["rentee"])){
                    echo '<td>'.$rented["rentee"].'</td>';
                }else{
                    echo '<td>Currently Available</td>';
                    echo '<td><button class="btn btn-info" id="transferButton" value="'.$row['id'].'" onclick="transfer(this)">Transfer</button></td>';
                    echo '<td><select id="transferList">';
                    $locations = sqlgetLocation();
                    while ($location = $locations->fetch_assoc()) {
                        if($location['name'] !== $row["location"]){
                            echo '<option value="'.$location['locationid'].'">'.$location['name'].' - '.$location['postcode'].'</option>';
                        }
                    }
                    echo '</select></td>';
                }
                echo '<tr>';
            }
            ?>
    </table>

<?php }
