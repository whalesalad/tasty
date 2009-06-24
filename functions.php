<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */


function tasty_stylesheet_url(){
    $tasty_color_option = split('_', get_option('tasty_color'));
    $tasty_color = (isset($tasty_color_option[1])) ? $tasty_color_option[1] : 'pink';
    echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory').'/css/'.$tasty_color.'.css" />';
}

function tasty_sidebar_alignment(){
    $tasty_sidebar_alignment = get_option('tasty_sidebar_alignment');
    $tasty_sidebar_alignment = ($tasty_sidebar_alignment) ? $tasty_sidebar_alignment : 'right';
    return $tasty_sidebar_alignment;
}

function tasty_header(){
    get_header();

    $alignment = tasty_sidebar_alignment();
    if ($alignment == 'left') get_sidebar();
}

function tasty_footer(){
    $alignment = tasty_sidebar_alignment();
    if ($alignment == 'right') get_sidebar();
    
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


// Admin Shenanigans
add_action('admin_menu', 'tasty_add_options_pages');
add_action('admin_post_tasty_save', 'tasty_save_options');

function tasty_add_options_pages(){
    add_theme_page(__('Tasty Theme Options', 'tasty'), __('Tasty Theme Options', 'tasty'), 'edit_themes', 'tasty-options', 'tasty_options_admin');
}

function tasty_options_admin(){ 
    add_option('tasty_color', 'tasty_pink', '', 'yes');
    add_option('tasty_sidebar_alignment', 'right', '', 'yes');
    
    $tasty_color = get_option('tasty_color');
    $tasty_sidebar_alignment = get_option('tasty_sidebar_alignment');
    
    ?>
    <h2><?php _e('Tasty Theme Options', 'tasty'); ?></h2>
    
    <?php if ($_GET['saved']) { ?>
        <div id="updated" class="updated fade">
            <p><?php echo __('Theme options saved!', 'tasty').' <a href="'.get_bloginfo('url').'/">'.__('View your website &rarr;', 'tasty').'</a>'; ?></p>
        </div>
    <?php } ?>
    
    <ul>
        <li><strong>Choose between colors:</strong> Hot Pink, Neon Green, Bright Purple, Bright Cyan, Orange, Red, Gunmetal.</li>
        <li><strong>Social Badges:</strong> RSS url or feedburner url, if no rss url, no email badge, youtube, twitter, myspace, facebook, flickr, delicious</li>
    </ul>
    <form action="<?php echo admin_url('admin-post.php?action=tasty_save'); ?>" method="POST">
        <p>
            <label for="tasty_color">Color Scheme:</label>
            <select name="tasty_color" id="tasty_color">
                <option value="tasty_pink"<?php if ($tasty_color == 'tasty_pink') echo ' selected="selected"'; ?>>Pink</option>
                <option value="tasty_green"<?php if ($tasty_color == 'tasty_green') echo ' selected="selected"'; ?>>Green</option>
                <option value="tasty_orange"<?php if ($tasty_color == 'tasty_orange') echo ' selected="selected"'; ?>>Orange</option>
                <option value="tasty_purple"<?php if ($tasty_color == 'tasty_purple') echo ' selected="selected"'; ?>>Purple</option>
                <option value="tasty_blue"<?php if ($tasty_color == 'tasty_blue') echo ' selected="selected"'; ?>>Blue</option>
            </select>
        </p>
        <p>
            <label for="tasty_sidebar_alignment">Sidebar Alignment:</label>
            <select name="tasty_sidebar_alignment" id="tasty_sidebar_alignment">
                <option value="right"<?php if ($tasty_sidebar_alignment == 'right') echo ' selected="selected"'; ?>>Right (Default)</option>
                <option value="left"<?php if ($tasty_sidebar_alignment == 'left') echo ' selected="selected"'; ?>>Left</option>
            </select>
        </p>
        
        <p><input type="submit" name="submit" value="Save Settings"></p>
    </form>
<?php } 

function tasty_save_options(){
    if (!current_user_can('edit_themes'))
        wp_die(__('Sorry, you don\'t have sufficient admin privileges to modify theme settings.', 'tasty'));

    if (isset($_POST['submit'])) {
        // Color Scheme
        $tasty_color = ($_POST['tasty_color']) ? $_POST['tasty_color'] : 'tasty_pink';
        update_option('tasty_color', $tasty_color);
        
        // Sidebar Alignment
        $tasty_sidebar_alignment = ($_POST['tasty_sidebar_alignment']) ? $_POST['tasty_sidebar_alignment'] : 'right';
        update_option('tasty_sidebar_alignment', $tasty_sidebar_alignment);
    }

    wp_redirect(admin_url('themes.php?page=tasty-options&saved=true'));

}

?>