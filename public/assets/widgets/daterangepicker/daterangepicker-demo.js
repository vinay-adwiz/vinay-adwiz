/* Daterangepicker bootstrap */


$(function() {
    "use strict";

    $('#daterangepicker-time').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'DD/MM/YYYY h:mm'
    });

});