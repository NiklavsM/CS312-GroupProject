<?php
include_once "dependencies/header.php";

?>

    <div class="container">
        <h1>Our cars</h1>
        <div class="row">
            <div class="col-sm-2">

                <div class="panel panel-info">
                    <div class="panel-heading">Filter</div>
                    <div class="panel-body">
                        <form id="selectCarsForm" method="post">
                            <table>
                                <tr>
                                    <td>Make:</td>
                                    <td>
                                        <select id="make" name="make">
                                            <option value=""></option>
                                            <option value="Ford">Ford</option>
                                            <option value="Audi">Audi</option>
                                            <option value="Merc">Merc</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Model:</td>
                                    <td>
                                        <select id="model" name="model">
                                            <option value=""></option>
                                            <option value="Fiesta">Fiesta</option>
                                            <option value="Audi">2</option>
                                            <option value="Merc">3</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Filter" class="btn btn-success">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <h2>Selected cars</h2>
                <div id="tablePlaceHolder">

                </div>

            </div>
        </div>
    </div>
    <script type='text/javascript'>
        /* attach a submit handler to the form */
        $("#selectCarsForm").submit(function (event) {

            /* stop form from submitting normally */
            event.preventDefault();

            /* get the action attribute from the <form action=""> element */
            var $form = $(this),
                url = $form.attr('action');

            /* Send the data using post with element id name and name2*/
            var posting = $.post("carTable.php", {make: $('#make').val(), model: $('#model').val()});

            /* Alerts the results */
            posting.done(function (data) {
                document.getElementById("tablePlaceHolder").innerHTML = data
                console.log("Here ", data);
                // alert('success');
            });
        });
    </script>
<?php
include_once "dependencies/footer.php";
