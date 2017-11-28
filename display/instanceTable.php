<?php
include_once "~../../../model/database.php";

$locationID= input("location");
$option = input("filter");
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
        <th></th>
        <tr>
            <?php
            foreach ($resultArray as $row) {

                $rentingResult = sqlCheckisRented($row['id']);
                $rented = $rentingResult->fetch_assoc();
                $isRented = isset($rented["rentee"]);
                if($option === "1" || $isRented && $option === "3" || !$isRented && $option === "2"){
                    echo '<tr>';
                    if($isRented){
                        echo '<td></td>';
                    }else{
                        echo '<td><button class="btn btn-danger" value="'.$row['id'].'" onclick="handleDelete(this)">Delete</button></td>';
                    }
                    echo '<td>' . $row["make"] . '</td>';
                    echo '<td>' . $row["model"] . '</td>';
                    echo '<td><img src="../img/'.$row["img"].'" alt="Car with make '.$row["make"].' and model '.$row["model"].'" height="90" width="90"></td>';
                    if($locationID === "NA"){
                        echo '<td>' . $row["location"] . '</td>';
                    }
                    if($isRented){
                        echo '<td>'.$rented["rentee"].'</td>';
                        echo '<td><button class="btn btn-sm" id="stopRentButton" value="'.$row['id'].'" onclick="stopRent(this)">Recieved</button></td>';
                    }else{
                        echo '<td>Currently Available</td>';
                        ?>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Transfer
                                </button>
                                <div class="dropdown-menu">
                                    <?php
                                    $locations = sqlgetLocation();
                                    while ($location = $locations->fetch_assoc()) {
                                        if($location['name'] !== $row["location"]){
                                            echo '<a class="dropdown-item" href="javascript:;" onclick="transfer('.$row['id'].','.$location['locationid'].')">'.$location['name'].' - '.$location['postcode'].'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                        <?php
                    }
                    echo '</tr>';
                }

            }
            ?>
    </table>

<?php }
