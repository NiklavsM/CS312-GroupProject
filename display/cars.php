<?php
include_once "dependencies/header.php";

?>
<div class="container">

    <h1>Select car</h1>
    <form method="post">

        <select name="maker">
            <option value=""></option>
            <option value="Ford">Ford</option>
            <option value="Audi">Audi</option>
            <option value="Merc">Merc</option>
        </select>
        <select name="model">
            <option value=""></option>
            <option value="Fiesta">Fiesta</option>
            <option value="Audi">2</option>
            <option value="Merc">3</option>
        </select>
        <input type="submit" value="Select" class="btn btn-success">
    </form>
</div>

<?php
$maker = input("maker");
$model = input("model");

if(isset($maker)) {
    include_once "carTable.php";
}

include_once "dependencies/footer.php";
