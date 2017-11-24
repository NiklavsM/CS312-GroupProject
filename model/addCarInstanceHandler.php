<?php
include_once "database.php";
$loc    = input("location");
$make   = input("make");
$model = input("model");

?>
<form id="response" action="~/../../display/addCar.php" method="post">
    <?php

//    echo "got here";

    if($loc !== "" && $make !== "" && $model !== ""){
//        echo "got here2";
        $response = getTypeFromMakeAndModel($make, $model);
//    if($response->num_rows >0){
        $row = $response->fetch_assoc();
        insertCar($loc, $row['typeid']);
//        echo $row['typeid'];
//    }else{
        echo '<input type="hidden" name="response" value="'.$row['typeid'].'">';
//    }
    }

    ?>
</form>
<!--<script type="text/javascript">-->
<!--    document.getElementById('response').submit();-->
<!--</script>-->

