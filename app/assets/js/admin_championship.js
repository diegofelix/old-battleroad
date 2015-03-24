$(document).ready(function(){
    $("#payment-filter").on('click', 'button', function(){
        var $status = $(".status").slideUp();
        var statusSelected = $(this).data('status');

        if (statusSelected == "all") $status.slideDown();

        $('.status-' + statusSelected).slideDown();
    });

    $('.checkin-form').on('click', function(e){

        e.preventDefault();

        var $form = $(this);
        var formData = $form.serialize();
        var $button = $form.find('button').button('loading');

        return $.post($form.attr('action'), formData)
            .done(function(){$button.button('reset');})
            .success(function(){$button.toggleClass('btn-success');})
            .error(function(){alert('Houve um erro de comunicação, se o problema persistir, contate o administrador.');});

        // $button = $(this);
        // $(this).button('loading');

        // checkUser($button);
    });

    /**
     * Checkin or checkout a user
     *
     * @param  {jQueryObject} $button
     * @return {void}
     */
    function checkUser($button)
    {
        var url = '/admin/';
        url += ($button.hasClass('btn-success')) ? 'checkout' : 'checkin';


    }
});