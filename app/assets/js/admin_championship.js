$(document).ready(function(){
    $("#payment-filter").on('click', 'button', function(){
        var $status = $(".status").slideUp();
        var statusSelected = $(this).data('status');

        if (statusSelected == "all") $status.slideDown();

        $('.status-' + statusSelected).slideDown();
    });
});