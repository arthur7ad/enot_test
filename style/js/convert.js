$(document).ready(function () {

    $('#ajax_form').keyup(function() {
        sendAjaxForm('result_form', 'ajax_form', 'convert.php');
        return false;
    });
    $('#amount2').keyup(function() {
        sendAjaxForm2('result_form', 'ajax_form', 'convert.php');
        return false;
    });
    $('#select1').change(function () {
        sendAjaxForm('result_form', 'ajax_form', 'convert.php');
        return false;
    });
    $('#select2').change(function () {
        sendAjaxForm('result_form', 'ajax_form', 'convert.php');
        return false;
    });

});

function sendAjaxForm(results, ajax_form, url) {
    $.ajax({
        url: "/convert.php",
        type: "POST",
        dataType: "html",
        data: $("#" + ajax_form).serialize() + '&typ=1',
        success: function (data) {
            $("#amount2").val(data);

        },
        error: function (response) {
            $('#results').html('<div class="alert alert-danger">Ошибка. Данные не отправлены.</div><br>');
        }
    });
}


function sendAjaxForm2(results, ajax_form, url) {
    $.ajax({
        url: "/convert.php",
        type: "POST",
        dataType: "html",
        data: $("#" + ajax_form).serialize() + '&typ=2',
        success: function (data) {
            $("#amount1").val(data);

        },
        error: function (response) {
            $('#results').html('<div class="alert alert-danger">Ошибка. Данные не отправлены.</div><br>');
        }
    });
}
