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
    // add_option('tasty_color', 'tasty_pink', '', 'yes');
    // add_option('tasty_sidebar_alignment', 'right', '', 'yes');
    
    $tasty_settings = new Settings;
    $tasty_settings->get_settings();
    
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
        
        <p><input type="submit" name="submit" value="Save Settings"></p>
    </form>
<?php } 

function tasty_save_options(){
    if (!current_user_can('edit_themes'))
        wp_die(__('Sorry, you don\'t have sufficient admin privileges to modify theme settings.', 'tasty'));

    if (isset($_POST['submit'])) {
        $tasty_settings = new Settings;

        // Color Scheme
        $tasty_settings->color = ($_POST['tasty_color']) ? $_POST['tasty_color'] : 'tasty_pink';
        
        // Sidebar Alignment
        $tasty_settings->sidebar_alignment = ($_POST['tasty_sidebar_alignment']) ? $_POST['tasty_sidebar_alignment'] : 'right';
        
        $tasty_settings->save_settings();
    }

    wp_redirect(admin_url('themes.php?page=tasty-options&saved=true'));

}

?>