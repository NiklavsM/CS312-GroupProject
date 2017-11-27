/* attach a submit handler to the form */
$("#selectCarsForm").submit(function (event) {

    /* stop form from submitting normally */
    event.preventDefault();

    /* get the action attribute from the <form action=""> element */
    var $form = $(this),
        url = $form.attr('action');

    /* Send the data using post with element id name and name2*/
    var posting = $.post("carTable.php", {make: $('#make').val(), model: $('#model').val(), minPrice: $('#min').val(),maxPrice: $('#max').val()});

    /* Alerts the results */
    posting.done(function (data) {
        document.getElementById("tablePlaceHolder").innerHTML = data
        console.log("Here ", data);
        // alert('success');
    });
});
