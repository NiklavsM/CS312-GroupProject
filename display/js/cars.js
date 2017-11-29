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

var loadCars = function () {
    var posting = $.post("carTable.php", {
        make: $('#make').val(),
        model: $('#model').val(),
        minPrice: $('#min').val(),
        maxPrice: $('#max').val(),
        dateFrom: $('#dateFromId').val(),
        dateTo:  $('#dateToId').val()
        });
    /* Alerts the results */
    posting.done(function (data) {
        document.getElementById("tablePlaceHolder").innerHTML = data

    });
}

function currentDate() {
    var today = new Date();
    var mm = today.getMonth() + 1; //January is 0!
    var dd = today.getDate();
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var today = yyyy + '-' + mm + '-' + dd;
    $('#dateFromId').attr('min', today);
}

currentDate();
$('#dateFromId').on('change', function () {
    var date = $('#dateFromId').val();
    var dates = date.split("-");
    var d = new Date();
    d.setFullYear(dates[0], dates[1] - 1, dates[2]);
    d.setDate(d.getDate() + 1);
    var day = d.getDate();
    var month = (d.getMonth() + 1);
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }
    var date = d.getFullYear() + '-' + month + '-' + day;
    $('#dateToId').attr("min", date);
});
$('#dateToId').on('change', function () {
    var date = $('#dateToId').val();
    var dates = date.split("-");
    var d = new Date();
    d.setFullYear(dates[0], dates[1] - 1, dates[2]);
    d.setDate(d.getDate() - 1);
    var day = d.getDate();
    var month = (d.getMonth() + 1);
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }
    var date = d.getFullYear() + '-' + month + '-' + day;
    $('#dateFromId').attr("max", date);
});


window.onload = loadCars;
