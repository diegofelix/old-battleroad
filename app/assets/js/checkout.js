$('document').ready(function(){
    var $total = $("#totalprice");

    $(".input-competition").click(function(){
        var price = $(this).data('price');

        if ( ! $(this).is(':checked'))
        {
            price = price * -1;
        }

        var newTotal = parseFloat($total.text()) + price;
        $total.text(newTotal);
    });
});