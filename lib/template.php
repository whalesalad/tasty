<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

// Outputs various stylesheets
function tasty_styles(){
    global $tasty_settings;
    
    // Base CSS Style
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_url').'" />'."\n";

    // Color-specific CSS Style
    $tasty_color = (isset($tasty_settings->color)) ? $tasty_settings->color : 'pink';
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory').'/css/'.$tasty_color.'.css" />'."\n";
    
    // If custom header
    $style = array();
    $style[] = '<style type="text/css" media="screen">';
    $style[] = 'body { background-color: '.$tasty_settings->background_color.' } ';
    $style[] = '.innerTop { background-color: '.$tasty_settings->background_color.' } ';
    $style[] = '#footer, #footer a { color: '.$tasty_settings->footer_color.' } ';

    if ($tasty_settings->custom_header_image) {
        $style[] = '#wrapper #header { background-image: url('. $tasty_settings->custom_header_image .') !important; }';
    }
    
    $style[] = '</style>';
    echo implode($style, "\n");
}

// Returns sidebar alignment
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

function tasty_title($length = 35){
    $title = get_the_title();

    if (strlen($title) > $length) {
        $suffix = '...';
        $short_title = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($title)));
        $title = trim(substr($short_title, 0, $length));
        $lastchar = substr($title, -1, 1);
        if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';
        $title .= $suffix;
    }

    if (strlen($title) == 0)
        $title = "Untitled";
    
    echo $title;
}

function tasty_variable_title(){
    $title = get_the_title();
    $length = strlen($title);
    
    $size = 'xlarge';

    if ($length > 65) {
        $size = 'smallest';
    } else if ($length > 55) {
        $size = 'small';
    } else if ($length > 45) {
        $size = 'medium';
    } else if ($length > 35) {
        $size = 'large';
    }
    
    echo $size;
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
            <?php edit_comment_link('EDIT COMMENT', ' &bull; ', ''); ?> 
        </div>
<?php } 

function ws_next_posts_link($label = 'Next Page &raquo;', $max_page = 0) {
    global $paged, $wp_query;

    if (!$max_page) $max_page = $wp_query->max_num_pages;

    if (!$paged) $paged = 1;

    $nextpage = intval($paged) + 1;

    if (!is_single() && (empty($paged) || $nextpage <= $max_page)) {
        $attr = apply_filters( 'next_posts_link_attributes', '' );
        return '<a class="left" href="'.next_posts($max_page, false)."\" $attr>".preg_replace('/&([^#])(?![a-z]{1,8};)/', '&#038;$1', $label) .'</a>';
    }
}

function ws_previous_posts_link($label = '&laquo; Previous Page') {
    global $paged;

    if (!is_single() && $paged > 1) {
        $attr = apply_filters('previous_posts_link_attributes', '');
        return '<a class="right" href="'.previous_posts(false)."\" $attr>".preg_replace('/&([^#])(?![a-z]{1,8};)/', '&#038;$1', $label).'</a>';
    }
}

function ws_pagination() {
    if (ws_next_posts_link() OR ws_previous_posts_link()) {
        echo '<div class="pagination">';
        echo ws_next_posts_link('&laquo; Older Posts', '0');
        echo ws_previous_posts_link('Newer Posts &raquo;', '0');
        echo '</div>';
    }
}

// SocialGrid class. Instantiated in sidebar, renders grid of Social Media buttons.
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
        if (!isset($button["url"]))
            return;
            
        echo '<li class="button '.$class.'"><a href="'.$button["url"].'" target="_blank">'.$button["text"].'</a></li>';
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