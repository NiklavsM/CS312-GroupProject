<?php

include_once "dependencies/header.php";
?>
<!--Actual page content goes here-->
<div class="jumbotron bg-dark">
        <div class="jumbotron fg-dark">
        <p><?php
            if ($successfulLogin) {
                echo "Welcome back, $username.";
            } else {
                echo "You should probably login.";
            } ?>
        </p>
</div>
    <div class="jumbotron fg-dark">
          <?php
                include_once "~../../../model/messageOfTheDay.php";
          ?>
    </div>
</div>

<!--Optional Javascript goes here-->
<?php
include_once "dependencies/footer.php";

?>
