<?php
include_once "dependencies/header.php";
$maker = input("maker");
$model = input("model");

$result = sqlGetCarswithFilter($maker,$model);
?>
<div class="container">

    <h1>Select car</h1>
    <form method="post">

        <select name = "maker">
            <option value="BMW">BMW</option>
            <option value="Audi">Audi</option>
            <option value="Merc">Merc</option>
        </select>
        <select name = "model">
            <option value="BMW">1</option>
            <option value="Audi">2</option>
            <option value="Merc">3</option>
        </select>
        <input type="submit" value="Select" class="btn btn-success">
    </form>


<!--    <table>-->
<!--        <tr>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"class="tdItem" src="https://cdn.pixabay.com/photo/2014/10/26/22/20/bucket-504526_960_720.jpg">-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="?">-->
<!--                <h6>img</h6>-->
<!--            </td>-->
<!--            <td class="tdItem">-->
<!--                <img class="table_image"src="https://cdn.pixabay.com/photo/2014/10/26/22/20/bucket-504526_960_720.jpg">-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
</div>

<?php
include_once "dependencies/footer.php";
?>
