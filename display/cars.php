<?php
include_once "dependencies/header.php";

?>

<div class="container">

    <h1>Select cars</h1>
    <form id = "selectCarsForm" method="post">

        <select id="make" name="make">
            <option value=""></option>
            <option value="Ford">Ford</option>
            <option value="Audi">Audi</option>
            <option value="Merc">Merc</option>
        </select>
        <select id="model" name="model">
            <option value=""></option>
            <option value="Fiesta">Fiesta</option>
            <option value="Audi">2</option>
            <option value="Merc">3</option>
        </select>
        <input type="submit" value="Select" class="btn btn-success">
    </form>
</div>
    <script type='text/javascript'>
        /* attach a submit handler to the form */
        $("#selectCarsForm").submit(function(event) {

            /* stop form from submitting normally */
            event.preventDefault();

            /* get the action attribute from the <form action=""> element */
            var $form = $( this ),
                url = $form.attr( 'action' );

            /* Send the data using post with element id name and name2*/
            var posting = $.post( "carTable.php", { make: $('#make').val(), model: $('#model').val() } );

            /* Alerts the results */
            posting.done(function( data ) {
                document.getElementById("tablePlaceHolder").innerHTML = data
                console.log("Here ",data);
               // alert('success');
            });
        });
    </script>
    <div id="tablePlaceHolder">

    </div>

<?php
$maker = input("maker");
$model = input("model");

if(isset($maker)) {
    //include_once "carTable.php";
}

include_once "dependencies/footer.php";
