$(document).ready(function(){
    $('.togglable-help').on('focus', function(){
        $(this).parent().find('.help-block').removeClass('hide');
    });
    $('.togglable-help').on('blur', function(){
        $(this).parent().find('.help-block').addClass('hide');
    });
});