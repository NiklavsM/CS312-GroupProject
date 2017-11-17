<?php
include_once "dependencies/header.php";
//include_once "~/../model/database.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    function updateModels(maker){
        console.log("read value as: " + maker);
        jQuery.ajax()({
            type: 'POST',
            url: '~/../model/dropDownHandler.php',
            data: {maker: maker},
            success: function(data) {
                alert(data);
            }
        });
    }


</script>

    <form method="post">
        <input type ="text" name="carRegNr">
        <select id="carMaker" name = "carMaker" onchange="updateModels(this.value)">
            <?php
            $carTypes = sqlGetCarsMakers();
            while ($type = $carTypes->fetch_assoc()) {
                echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
            }
            ?>
        </select>
        <select name ="carModel">
        </select>
        <input type="submit" value="Add" class="btn btn-success">
    </form>

<?php
include_once "dependencies/footer.php";
?>
