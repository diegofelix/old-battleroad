$(document).ready(function(){

    // hide the content of champ info
    $('#champ-info .content').hide();

    // show and hide divs when clicked
    $('.show-hide').on('click', function(){
        $this = $(this);
        $this.find(".icon").toggleClass('icon-caret-up');
        $this.find('.content').toggle();
    });
});