/* attach a submit handler to the form */
$("#selectCarsForm").submit(function (event) {

    /* stop form from submitting normally */
    event.preventDefault();

    loadCars();
});

$(function () {
    $('#make').on('change', function () {
        //get current selected item from carMaker
        var f = $('#make').val();
        //send f to dropDownHandler
        $.ajax({
            url: '~/../../model/dropDownHandler.php',
            type: 'post',
            data: {'make': f}
        }).done(function (msg) {
            //insert html into selection
            document.getElementById('model').innerHTML = msg;
        })
            .fail(function () {
                alert("error");
            })
            .always(function () {
            });
    });
});

var loadCars = function(){
    var posting = $.post("carTable.php", {make: $('#make').val(), model: $('#model').val(), minPrice: $('#min').val(),maxPrice: $('#max').val()});
    /* Alerts the results */
    posting.done(function (data) {
        document.getElementById("tablePlaceHolder").innerHTML = data

    });
}
window.onload = loadCars;
