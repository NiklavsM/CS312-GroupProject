<?php
include_once "dependencies/header.php";
?>
<!--Actual page content goes here-->
     <div class="jumbotron container">
        <div class="row">
            <p><?php
                if ($successfulLogin) {
                    echo "Welcome back, $username. Have a free car.";
                } else {
                    echo "You should probably login.";
                } ?>
            </p>
        </div>
    </div>

<!--Optional Javascript goes here-->
<?php
include_once "dependencies/footer.php";
?>
