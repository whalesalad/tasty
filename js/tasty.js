$(document).ready(function(){
    $('div.commentRespond input, div.commentRespond textarea, #searchInput').each(function(index) {
        $(this).focus(function() {
            $(this).siblings('span.label, label.span').hide();
        }).blur(function() {
            if (!$(this).val()) { $(this).siblings('span.label, label.span').show(); }
        });

        if ($(this).val()) { $(this).siblings('span.label, label.span').hide(); }
    });
    
});