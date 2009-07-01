<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

function tasty_styles(){
    global $tasty_settings;
    
    // Base CSS Style
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_url').'" />'."\n";

    // Color-specific CSS Style
    $tasty_color = (isset($tasty_settings->color)) ? $tasty_settings->color : 'pink';
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory').'/css/'.$tasty_color.'.css" />'."\n";
}

function tasty_sidebar_alignment(){
    global $tasty_settings;

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

class SocialGrid {
    function __construct() {
        $this->buttons = array(
            "rss" => array(
                "text" => "Subscribe to My Feed",
                "url" => $this->get_rss_url()
            ),
            "email" => array(
                "text" => "Subscribe via Email",
                "url" => $this->get_email_url()
            ),
            "youtube" => array(
                "text" => "My YouTube Videos",
                "url" => $this->get_youtube_url()
            ),
            "twitter" => array(
                "text" => "My Twitter Profile",
                "url" => $this->get_twitter_url()
            ),
            "facebook" => array(
                "text" => "My Facebook Profile",
                "url" => $this->get_facebook_url()
            ),
            "myspace" => array(
                "text" => "My MySpace Profile",
                "url" => $this->get_myspace_url()
            ),
            "flickr" => array(
                "text" => "My Flickr Photos",
                "url" => $this->get_flickr_url()
            ),
            "delicious" => array(
                "text" => "My Delicious Bookmarks",
                "url" => $this->get_delicious_url()
            )
        );
        
        $this->render_buttons($this->buttons);
        
    }
    
    function create_button($class, $button) {
        if (!isset($button["url"])) {
            return;
        }
        // Takes a button, Array [text, class, url] and prints it
        echo '<li class="button '.$class.'"><a href="'.$button["url"].'">'.$button["text"].'</a></li>';
    }
    
    function render_buttons($buttons) {
        echo '<ul class="socialButtons">';
        foreach ($buttons as $key => $value) {
            $this->create_button($key, $value);
        }
        echo '</ul>';
    }
    
    function get_rss_url() {
        global $tasty_settings;
        if ($tasty_settings->rss_url) {
            return 'http://feeds2.feedburner.com/'.$tasty_settings->rss_url;
        } else {
            return get_bloginfo('rss2_url');
        }
    }
    
    function get_email_url() {
        global $tasty_settings;
        if ($tasty_settings->rss_url)
            return 'http://feedburner.google.com/fb/a/mailverify?uri='.$tasty_settings->rss_url;
    }
    
    function get_youtube_url() {
        global $tasty_settings;
        if ($tasty_settings->youtube_url)
            return 'http://youtube.com/'.$tasty_settings->youtube_url;
    }
    
    function get_twitter_url() {
        global $tasty_settings;
        if ($tasty_settings->twitter_url)
            return 'http://twitter.com/'.$tasty_settings->twitter_url;
    }
    
    function get_facebook_url() {
        global $tasty_settings;
        if ($tasty_settings->facebook_url)
            return 'http://facebook.com/'.$tasty_settings->facebook_url;
    }
    
    function get_myspace_url() {
        global $tasty_settings;
        if ($tasty_settings->myspace_url)
            return 'http://myspace.com/'.$tasty_settings->myspace_url;
    }
    
    function get_flickr_url() {
        global $tasty_settings;
        if ($tasty_settings->flickr_url)
            return 'http://flickr.com/photos/'.$tasty_settings->flickr_url;
    }
    
    function get_delicious_url() {
        global $tasty_settings;
        if ($tasty_settings->delicious_url)
            return 'http://delicious.com/'.$tasty_settings->delicious_url;
    }
    
}


?>