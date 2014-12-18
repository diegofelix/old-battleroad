$(document).ready(function()
{
    var rate = $("#price").data('rate');

    $("#price").on('keyup', function(){
        var updatedPrice = $(this).val().replace(',', '.');
        $(this).val(updatedPrice);
        var price = calcPrice("#price", rate);
        $("#preview").val(price);
    });

    // preco com taxa
    $("#preview").on('keyup', function(){
        var price = calcPrice("#preview", rate, true);
        $("#price").val(price);
    });
});
function calcPrice(thePrice, tax, inverted)
{
    var currentPrice = $(thePrice).val().replace(',', '.');
    var result = 0;
    if (currentPrice > 0)
    {
        if (inverted)
        {
            result = currentPrice * ((100 - tax) / 100);
        }
        else
        {
            result = (currentPrice / (100 - tax)) * 100;
            // result = currentPrice * (1+ (tax/100));
        }
    }
    return result.toFixed(2);
}