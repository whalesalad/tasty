jQuery(document).ready(function(jQuery){
    jQuery('div.commentRespond input, div.commentRespond textarea, #searchInput').each(function(index) {
        jQuery(this).focus(function() {
            jQuery(this).siblings('span.label, label.span').hide();
        }).blur(function() {
            if (!jQuery(this).val()) { jQuery(this).siblings('span.label, label.span').show(); }
        });

        if (jQuery(this).val()) { jQuery(this).siblings('span.label, label.span').hide(); }
    });
    
    if (!jQuery.browser.msie) {
        jQuery('ul.socialButtons li').each(function(index) {
            var button = jQuery(this);

            // Create a tooltip for each button
            var tooltipContent = new Array(
                '<span class="left"></span>',
                '<span class="center">'+jQuery(this).children('a').text()+'</span>',
                '<span class="right"></span>');

            var tooltip = jQuery('<div/>').attr('class', 'tooltip').html(tooltipContent.join('')).appendTo(jQuery(this));

            tooltip.css('left', -(tooltip.width()/2)+25).bind('click', function(event) {
                window.location = button.children('a').attr('href');
            });

            button.hover(function() {
                tooltip.fadeIn('fast');
            }, function() {
                tooltip.fadeOut('fast');
            });
        });
    }
});