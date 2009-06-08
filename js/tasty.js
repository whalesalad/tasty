$(document).ready(function(){
    $('div.commentRespond input, div.commentRespond textarea').each(function(index) {
        $(this).focus(function() {
            $(this).siblings('span.label').hide();
        }).blur(function() {
            if (!$(this).val()) {
                $(this).siblings('span.label').show();
            }
        });

        if ($(this).val()) {
            $(this).siblings('span.label').hide();
        }
    });
});