$(document).ready(function(){
    $('div.commentRespond input, div.commentRespond textarea, #searchInput').each(function(index) {
        $(this).focus(function() {
            $(this).siblings('span.label, label.span').hide();
        }).blur(function() {
            if (!$(this).val()) { $(this).siblings('span.label, label.span').show(); }
        });

        if ($(this).val()) { $(this).siblings('span.label, label.span').hide(); }
    });
    
    $('ul.socialButtons li').each(function(index) {
        var button = $(this);
        
        // Create a tooltip for each button
        var tooltipContent = new Array(
            '<span class="left"></span>',
            '<span class="center">'+$(this).children('a').text()+'</span>',
            '<span class="right"></span>');
            
        var tooltip = $('<div/>').attr('class', 'tooltip').html(tooltipContent.join('')).appendTo($(this));
        
        tooltip.css('left', -(tooltip.width()/2)+25).bind('click', function(event) {
            window.location = button.children('a').attr('href');
        });
        
        $(this).hover(function() {
            tooltip.fadeIn('fast');
        }, function() {
            tooltip.fadeOut('fast');
        });
        
    });
});