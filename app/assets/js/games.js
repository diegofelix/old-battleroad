$('document').ready(function(){

    $('#event_start').inputmask("d/m/y",{ "placeholder": "dd/mm/aaaa" });

    // when user marks limit
    $('#limit-switch').on('click', function(){
        $('#limit-input').toggleClass('hide');
    });

});