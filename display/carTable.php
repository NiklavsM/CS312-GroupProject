<?php

include_once "~../../../model/database.php";
$maker= input("make");
$model= input("model");
$result = sqlGetCarswithFilter($maker, $model);
if ($result->num_rows > 0) {
    $resultArray = array();
    while ($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }
}
if (isset($resultArray)) {
    ?>
    <table name="Table">
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
                echo '<td>' . $row["price"] . '</td>';
                echo '<tr>';
            }
            ?>
    </table>
<?php }
