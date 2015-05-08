(function(){
    $(".panel-players").hide();
    var panelsLength = $(".panel-players").length;
    var bootstrapCols = 12;
    var oldWindowSize;
    $(".input-competition").on('click', function(){
        var windowSize = 12 / $(".input-competition:checked").length;
        var id = $(this).val();
        var $players = $("#competition-"+id);
        if ($(this).is(':checked')) {
            $players.slideDown();
        }
        else {
            $players.slideUp();//.removeClass('col-md-'+oldWindowSize);
        }
        $(".panel-players:visible").removeClass().addClass('panel-players col-md-'+windowSize);
        oldWindowSize = windowSize;
    });
})();