jQuery(document).ready(function(J) {
    var bg_color_input = J('#tasty_background_color'),
        bg_color_picker = J('#tasty_background_color_picker');

    bg_color_picker.farbtastic(bg_color_input);
    
    bg_color_input.bind('focus', function(event) {
        bg_color_picker.show();
    }).blur(function() {
        bg_color_picker.hide();
    });
});