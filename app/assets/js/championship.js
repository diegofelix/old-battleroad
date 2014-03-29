$(document).ready(function(){

    $("#price").inputmask('[9][9]99,99', { numericInput: true, "placeholder" : "" });
    $("#event_start, #event_end").inputmask('d/m/y h:s:00');

});