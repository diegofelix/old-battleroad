$('document').ready(function(){

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    console.log(now);

    // date picker
    $('#event_start').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    });

    // when user marks limit
    $('#limit-switch').on('click', function(){
        $('#limit-input').toggleClass('hide');
    });

});