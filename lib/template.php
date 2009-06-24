<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

function tasty_stylesheet_url(){
    $tasty_settings = new Settings;
    $tasty_settings->get_settings();
    
    $tasty_color = (isset($tasty_settings->color)) ? $tasty_settings->color : 'pink';
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory').'/css/'.$tasty_color.'.css" />';
}

function tasty_sidebar_alignment(){
    $tasty_settings = new Settings;
    $tasty_settings->get_settings();
    
    $tasty_sidebar_alignment = ($tasty_settings->sidebar_alignment) ? $tasty_settings->sidebar_alignment : 'right';
    return $tasty_sidebar_alignment;
}

function tasty_header(){
    get_header();
    if (tasty_sidebar_alignment() == 'left') get_sidebar();
}

function tasty_footer(){
    if (tasty_sidebar_alignment() == 'right') get_sidebar();
    get_footer();
}

function tasty_body_class(){
    $classes = array();
    $classes[$classes.length] = tasty_sidebar_alignment().'-sidebar';
    
    echo 'class="'.join(' ', $classes).'"';
}

if (function_exists('register_sidebar')){
    register_sidebar(array(
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

function tasty_render_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; 
    
    // Add unnaproved class to comment if it hasn't been approved yet
    $comment_class_str = '';
    if ($comment->comment_approved == 0)
        $comment_class_str = 'unapproved'; ?>
    <li <?php comment_class($comment_class_str); ?> id="comment-<?php comment_ID(); ?>">
        <div class="commentBody"><?php
            if ($comment->comment_approved){
                comment_text();
            } else {
                echo 'Your comment is awaiting moderation.';
            }
        ?>
        </div>
        <div class="commentMeta">
            <span class="authorStar">&#10029;</span>
            <a href="<?php comment_author_url() ?>"><?php comment_author() ?></a> on <?php comment_date() ?> at <?php comment_time() ?>.
        </div>
<?php } 

/**
* SocialGrid
* 
*/
/*
    <ul class="socialButtons">
        <li class="button rss"><a href="#rss">RSS</a></li>
        <li class="button email"><a href="#email">Email</a></li>
        <li class="button youtube"><a href="#youtube">Youtube</a></li>
        <li class="button twitter"><a href="#twitter">Twitter</a></li>
        <li class="button facebook"><a href="#facebook">Facebook</a></li>
        <li class="button myspace"><a href="#myspace">MySpace</a></li>
        <li class="button flickr"><a href="#flickr">Flickr</a></li>
        <li class="button delicious"><a href="#delicious">Delicious</a></li>
    </ul>
    
*/
// class SocialGrid {
//     
//     function __construct() {
//         // Get all the parameters for the shenanigans from the DB
//         $this->$rss_button = new array("text" => "RSS", "class" => "rss", "url" => NULL);
//         $this->$email_button = new array("text" => "Email", "class" => "email", "url" => NULL);
//         $this->$youtube_button = new array("text" => "YouTube", "class" => "youtube", "url" => NULL);
//         $this->$twitter_button = new array("text" => "Twitter", "class" => "twitter", "url" => NULL);
//         $this->$facebook_button = new array("text" => "Facebook", "class" => "facebook", "url" => NULL);
//         $this->$myspace_button = new array("text" => "MySpace", "class" => "myspace", "url" => NULL);
//         $this->$flickr_button = new array("text" => "Flickr", "class" => "flickr", "url" => NULL);
//         $this->$delicious_button = new array("text" => "Delicious", "class" => "delicious", "url" => NULL);
//     }
//     
// }


?>