<?php

include_once "~../../../model/database.php";
$maker = input("make");
$model = input("model");
$result = sqlGetCarsWithFilter($maker, $model);
if ($result->num_rows > 0) {
    $resultArray = array();
    while ($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }
}
if (isset($resultArray)) {
    ?>
    <table name="Table" class="table">
        </tr>
        <th>Maker</th>
        <th>Model</th>
        <th>Price</th>
        <tr>
            <?php
            foreach ($resultArray as $row) {
                echo '</tr>';
                echo '<td>' . $row["make"] . '</td>';
                echo '<td>' . $row["model"] . '</td>';
                echo '<td>£' . $row["price"] . '</td>';
                echo '<td><img src="../img/GoodCar.jpg" alt="Luxury at its finest" height="90" width="90"></td>';
                echo '<td><form action="rentCar.php" method="post">';
                echo '<input type = "hidden" name = "typeid" value = "' . $row["typeid"] . '" > ';
                echo '<input type = "hidden" name = "make" value = "' . $row["make"] . '" > ';
                echo '<input type = "hidden" name = "model" value = "' . $row["model"] . '" > ';
                echo '<input type = "hidden" name = "price" value = "' . $row["price"] . '" > ';
                echo '<input type = "submit" value = "Rent" > ';
                echo '</form ></td > ';
                echo '<tr > ';
            }
            ?>
    </table>
<?php }



