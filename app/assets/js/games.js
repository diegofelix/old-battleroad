$('document').ready(function(){

    $('#event_start').inputmask("d/m/y h:s",{ "placeholder": "dd/mm/aaaa hh:mm" });

    // when user marks limit
    $('#limit-switch').on('click', function(){
        $('#limit-input').toggleClass('hide');
    });

});