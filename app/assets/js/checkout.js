$('document').ready(function(){
    var $total = $("#totalprice");

    $(".input-competition").click(function(){
        var price = +$(this).data('price');
        var total = +$total.text();

        if ( ! $(this).is(':checked'))
        {
            price = price * -1;
        }

        var newTotal = (total + price).toFixed(2);
        $total.text(newTotal);
        // var price = +$(this).data('price');
        // var total = +$total.text();
        // var multiplier = 100;

        // price = price * multiplier;
        // total = total * multiplier;

        // if ( ! $(this).is(':checked'))
        // {
        //     price = price * -1;
        // }

        // var newTotal = total + price;
        // newTotal = newTotal/multiplier;
        // $total.text(newTotal);
    });
});