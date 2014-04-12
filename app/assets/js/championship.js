$(document).ready(function(){

    // mask the inputs when creating a championship
    $("#price").inputmask('[9][9]99,99', { numericInput: true, "placeholder" : "" });
    $("#event_start, #event_end").inputmask('d/m/y h:s:00');

    $('.description-label').hide();

    // show and hide divs when clicked
    $('.show-hide').click(function(){
        $this = $(this);
        $this.find('.info').slideToggle();
        $this.find('.description-label').toggle();
    });
});