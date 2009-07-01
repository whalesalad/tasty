<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

// Admin Shenanigans
add_action('admin_menu', 'tasty_add_options_pages');
add_action('admin_post_tasty_save', 'tasty_save_options');

function tasty_add_options_pages(){
    add_theme_page(__('Tasty Theme Options', 'tasty'), __('Tasty Theme Options', 'tasty'), 'edit_themes', 'tasty-options', 'tasty_options_admin');
}

function tasty_options_admin(){ 
    global $tasty_settings;
    
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
                <option value="pink"<?php if ($tasty_settings->color == 'pink') echo ' selected="selected"'; ?>>Pink</option>
                <option value="green"<?php if ($tasty_settings->color == 'green') echo ' selected="selected"'; ?>>Green</option>
                <option value="orange"<?php if ($tasty_settings->color == 'orange') echo ' selected="selected"'; ?>>Orange</option>
                <option value="purple"<?php if ($tasty_settings->color == 'purple') echo ' selected="selected"'; ?>>Purple</option>
                <option value="blue"<?php if ($tasty_settings->color == 'blue') echo ' selected="selected"'; ?>>Blue</option>
            </select>
        </p>
        <p>
            <label for="tasty_sidebar_alignment">Sidebar Alignment:</label>
            <select name="tasty_sidebar_alignment" id="tasty_sidebar_alignment">
                <option value="right"<?php if ($tasty_settings->sidebar_alignment == 'right') echo ' selected="selected"'; ?>>Right (Default)</option>
                <option value="left"<?php if ($tasty_settings->sidebar_alignment == 'left') echo ' selected="selected"'; ?>>Left</option>
            </select>
        </p>
        <p>
            <label for="tasty_header_text">Header Text:</label>
            <input type="checkbox" name="tasty_header_text" value="true" id="tasty_header_text" <?php if ($tasty_settings->header_text) echo' checked="checked"'; ?> />
        </p>
        
        <br />
        
        <p>
            <label for="tasty_rss_url">FeedBurner Username:</label>
            <input type="text" name="tasty_rss_url" value="<?php if ($tasty_settings->rss_url) echo $tasty_settings->rss_url; ?>" id="tasty_rss_url" />
            <span class="msg">This will blah blah</span>
        </p>
        
        <p>
            <label for="tasty_youtube_url">YouTube Username:</label>
            <input type="text" name="tasty_youtube_url" value="<?php if ($tasty_settings->youtube_url) echo $tasty_settings->youtube_url; ?>" id="tasty_youtube_url" />
        </p>
        
        <p>
            <label for="tasty_twitter_url">Twitter Username:</label>
            <input type="text" name="tasty_twitter_url" value="<?php if ($tasty_settings->twitter_url) echo $tasty_settings->twitter_url; ?>" id="tasty_twitter_url" />
        </p>
        
        <p>
            <label for="tasty_facebook_url">Facebook Username:</label>
            <input type="text" name="tasty_facebook_url" value="<?php if ($tasty_settings->facebook_url) echo $tasty_settings->facebook_url; ?>" id="tasty_facebook_url" />
        </p>
        
        <p>
            <label for="tasty_myspace_url">Myspace Username:</label>
            <input type="text" name="tasty_myspace_url" value="<?php if ($tasty_settings->myspace_url) echo $tasty_settings->myspace_url; ?>" id="tasty_myspace_url" />
        </p>
        
        <p>
            <label for="tasty_flickr_url">Flickr Username:</label>
            <input type="text" name="tasty_flickr_url" value="<?php if ($tasty_settings->flickr_url) echo $tasty_settings->flickr_url; ?>" id="tasty_flickr_url" />
        </p>
        
        <p>
            <label for="tasty_delicious_url">Delicious Username:</label>
            <input type="text" name="tasty_delicious_url" value="<?php if ($tasty_settings->delicious_url) echo $tasty_settings->delicious_url; ?>" id="tasty_delicious_url" />
        </p>
        
        <p><input type="submit" name="submit" value="Save Settings"></p>
    </form>
<?php } 

function tasty_save_options(){
    global $tasty_settings;
    
    if (!current_user_can('edit_themes'))
        wp_die(__('Sorry, you don\'t have sufficient admin privileges to modify theme settings.', 'tasty'));

    if (isset($_POST['submit'])) {
        // Color Scheme
        $tasty_settings->color = $_POST['tasty_color'];
        
        // Sidebar Alignment
        $tasty_settings->sidebar_alignment = $_POST['tasty_sidebar_alignment'];
        
        // Header Text
        $tasty_settings->header_text = (isset($_POST['tasty_header_text'])) ? true : false;
        
        // Social Grid
        $tasty_settings->rss_url = $_POST['tasty_rss_url'];
        $tasty_settings->youtube_url = $_POST['tasty_youtube_url'];
        $tasty_settings->twitter_url = $_POST['tasty_twitter_url'];
        $tasty_settings->facebook_url = $_POST['tasty_facebook_url'];
        $tasty_settings->myspace_url = $_POST['tasty_myspace_url'];
        $tasty_settings->flickr_url = $_POST['tasty_flickr_url'];
        $tasty_settings->delicious_url = $_POST['tasty_delicious_url'];
        
        $tasty_settings->save_settings();
    }

    wp_redirect(admin_url('themes.php?page=tasty-options&saved=true'));
}

?>