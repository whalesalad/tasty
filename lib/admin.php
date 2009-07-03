<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

// Admin Shenanigans
add_action('admin_menu', 'tasty_add_options_pages');
add_action('admin_post_tasty_save', 'tasty_save_options');
add_action('init', 'tasty_settings_head');

function tasty_add_options_pages(){
    add_theme_page(__('Tasty Theme Options', 'tasty'), __('Tasty Theme Options', 'tasty'), 'edit_themes', 'tasty-options', 'tasty_options_admin');
}

function tasty_settings_head() {
    wp_enqueue_style('tasty-settings-stylesheet', TASTY_STATIC . '/admin.css');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('tasty-admin-js', TASTY_STATIC . '/admin.js');
}


function tasty_options_admin(){ 
    global $tasty_settings; ?>
    <h2><?php _e('Tasty Theme Options', 'tasty'); ?></h2>
    <p>
    
    <?php if ($_GET['saved']) { ?>
        <div id="updated" class="updated fade">
            <p><?php echo __('Theme options saved!', 'tasty').' <a href="'.get_bloginfo('url').'/">'.__('View your website &rarr;', 'tasty').'</a>'; ?></p>
        </div>
    <?php } ?>
    
    <form action="<?php echo admin_url('admin-post.php?action=tasty_save'); ?>" method="POST">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="tasty_color"><?php _e('Color Scheme'); ?></label></th>
                <td>
                    <select name="tasty_color" id="tasty_color">
                        <option value="pink"<?php if ($tasty_settings->color == 'pink') echo ' selected="selected"'; ?>>Pink</option>
                        <option value="green"<?php if ($tasty_settings->color == 'green') echo ' selected="selected"'; ?>>Green</option>
                        <option value="orange"<?php if ($tasty_settings->color == 'orange') echo ' selected="selected"'; ?>>Orange</option>
                        <option value="purple"<?php if ($tasty_settings->color == 'purple') echo ' selected="selected"'; ?>>Purple</option>
                        <option value="blue"<?php if ($tasty_settings->color == 'blue') echo ' selected="selected"'; ?>>Blue</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="tasty_sidebar_alignment"><?php _e('Sidebar Alignment'); ?></label></th>
                <td>
                    <select name="tasty_sidebar_alignment" id="tasty_sidebar_alignment">
                        <option value="right"<?php if ($tasty_settings->sidebar_alignment == 'right') echo ' selected="selected"'; ?>>Right (Default)</option>
                        <option value="left"<?php if ($tasty_settings->sidebar_alignment == 'left') echo ' selected="selected"'; ?>>Left</option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="tasty_header_text"><?php _e('Header Text'); ?></label></th>
                <td>
                    <input type="checkbox" name="tasty_header_text" value="true" id="tasty_header_text" <?php if ($tasty_settings->header_text) echo' checked="checked"'; ?> />
                    <span class="description"><?php _e('If you have an elaborate header image, you can disable the text overlay.') ?></span>
                </td>
            </tr>
        </table>

        <h3><?php _e('SocialGrid') ?></h3>
        <p>The SocialGrid is a simple grid of social network links at the top of your sidebar. If you enter a username into any of the boxes below, that link will appear in your sidebar. Leave it empty to exclude it.</p>
        
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="tasty_socialgrid_enable"><?php _e('Enable SocialGrid'); ?></label></th>
                <td><input type="checkbox" name="tasty_socialgrid_enable" value="true" id="tasty_socialgrid_enable"<?php if ($tasty_settings->socialgrid_enabled) echo' checked="checked"'; ?> /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="tasty_rss_url"><?php _e('FeedBurner Username'); ?></label></th>
                <td><input type="text" name="tasty_rss_url" value="<?php if ($tasty_settings->rss_url) echo $tasty_settings->rss_url; ?>" id="tasty_rss_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_youtube_url"><?php _e('YouTube Username'); ?></label></th>
                <td><input type="text" name="tasty_youtube_url" value="<?php if ($tasty_settings->youtube_url) echo $tasty_settings->youtube_url; ?>" id="tasty_youtube_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_twitter_url"><?php _e('Twitter Username'); ?></label></th>
                <td><input type="text" name="tasty_twitter_url" value="<?php if ($tasty_settings->twitter_url) echo $tasty_settings->twitter_url; ?>" id="tasty_twitter_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_facebook_url"><?php _e('Facebook Vanity Name'); ?></label></th>
                <td><input type="text" name="tasty_facebook_url" value="<?php if ($tasty_settings->facebook_url) echo $tasty_settings->facebook_url; ?>" id="tasty_facebook_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_myspace_url"><?php _e('Myspace Username'); ?></label></th>
                <td><input type="text" name="tasty_myspace_url" value="<?php if ($tasty_settings->myspace_url) echo $tasty_settings->myspace_url; ?>" id="tasty_myspace_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_flickr_url"><?php _e('Flickr Username'); ?></label></th>
                <td><input type="text" name="tasty_flickr_url" value="<?php if ($tasty_settings->flickr_url) echo $tasty_settings->flickr_url; ?>" id="tasty_flickr_url" class="regular-text" /></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="tasty_delicious_url"><?php _e('Delicious Username'); ?></label></th>
                <td><input type="text" name="tasty_delicious_url" value="<?php if ($tasty_settings->delicious_url) echo $tasty_settings->delicious_url; ?>" id="tasty_delicious_url" class="regular-text" /></td>
            </tr>
            
        </table>
            
        <p class="submit">
            <input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Settings') ?>" />
        </p>
        
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
        $tasty_settings->socialgrid_enabled = (isset($_POST['tasty_socialgrid_enable'])) ? true: false;
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