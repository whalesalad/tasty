<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

$GLOBALS['content_width'] = 500;

// remove_action('wp_head', 'wp_generator');


/*

function resize_youtube($content) {
    return str_replace("width='425' height='344'></embed>", "width='240' height='197'></embed>", $content);
}


    <object width="425" height="344">
        <param name="movie" value="http://www.youtube.com/v/-SlWIaYkFI4&hl=en&fs=1&"></param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowscriptaccess" value="always"></param>
        <embed src="http://www.youtube.com/v/-SlWIaYkFI4&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed>
    </object>

    <object width="560" height="340">
        <param name="movie" value="http://www.youtube.com/v/dtvAZjIrKgE&hl=en&fs=1&"></param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowscriptaccess" value="always"></param>
        <embed src="http://www.youtube.com/v/dtvAZjIrKgE&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="560" height="340"></embed>
    </object>

add_filter( 'the_content', 'resize_youtube', 999 );

*/

?>