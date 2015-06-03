$('document').ready(function(){
    var $total = $("#totalprice");

    $(".input-competition").click(function(){
        var price = +$(this).data('price'); // puttin + before cast to number
        var total = +$total.text();
        var modal = $(this).data('target');
        var nicksButton = "#edit-nicks-" + $(this).val();

        $(nicksButton).removeClass('hide');

        if ( $(this).is(':checked')) $(modal).modal();

        if ( ! $(this).is(':checked'))
        {
            price = price * -1;
            $(nicksButton).addClass('hide');
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