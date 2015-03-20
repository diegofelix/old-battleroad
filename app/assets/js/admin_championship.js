$(document).ready(function(){
    $("#payment-filter").on('click', 'button', function(){
        var $status = $(".status").slideUp();
        var statusSelected = $(this).data('status');

        if (statusSelected == "all") $status.slideDown();

        $('.status-' + statusSelected).slideDown();
    });

    $('.checkin-button').on('click', function(){
        $button = $(this);
        $(this).button('loading');

        checkUser($button);
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

        return $.post(url, {join: $button.data('join')})
            .done(function(){$button.button('reset');})
            .success(function(){$button.toggleClass('btn-success');})
            .error(function(){alert('Houve um erro de comunicação, se o problema persistir, contate o administrador.');});
    }
});