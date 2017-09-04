$(function(){
    // maskinput
    $('input[name=birthdate]').inputmask("d/m/y",{ "placeholder": "dd/mm/aaaa" });

    // hide not checked competitions
    $('.form-nick').hide();

    var curTarget = $("input[type=checkbox]:checked").data('target');
    $(curTarget).show();

    $("input[type=checkbox]").on('change', function(){
        target = $(this).data('target');
        if (this.checked) {
            $(target).fadeIn();
        } else {
            $(target).fadeOut();
        }
    });
});