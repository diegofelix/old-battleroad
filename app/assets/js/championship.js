$(document).ready(function(){

    // mask the inputs when creating a championship
    /*$("#price").inputmask('[9][9]99,99', { numericInput: true, "placeholder" : "" });
    $("#event_start, #event_end").inputmask('d/m/y h:s:00');*/

    $('#event_start').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true
    });

    // hide the content of champ info
    $('#champ-info .content').hide();

    // show and hide divs when clicked
    $('.show-hide').on('click', function(){
        $this = $(this);
        $this.find(".icon").toggleClass('icon-caret-up');
        $this.find('.content').toggle();
    });
});