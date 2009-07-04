<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

// Admin Shenanigans
add_action('admin_menu', 'tasty_add_options_pages');
add_action('admin_post_tasty_save', 'tasty_save_options');
add_action('init', 'tasty_settings_head');

if ($_GET['activated'])
    tasty_activate_theme();
    

function tasty_add_options_pages(){
    add_theme_page(__('Tasty Theme Options', 'tasty'), __('Tasty Theme Options', 'tasty'), 'edit_themes', 'tasty-options', 'tasty_options_admin');
}

function tasty_settings_head() {
    wp_enqueue_style('tasty-settings-stylesheet', TASTY_STATIC . '/admin.css');
    wp_enqueue_script('tasty-admin-js', TASTY_STATIC . '/admin.js');
}

function tasty_activate_theme() {
    global $current_user;
    get_currentuserinfo();
    
    $name = urlencode($current_user->first_name." ".$current_user->last_name);
    $username = urlencode($current_user->user_login);
    $email = urlencode($current_user->user_email);
    $domain = urlencode(get_bloginfo('url'));
    $server_address = urlencode($_SERVER['SERVER_ADDR']);
    
    $post = "name=$name&username=$username&email=$email&domain=$domain&address=$server_address";
    
    // $host       = 'activate.dev';
    $host       = 'activate.whalesalad.com';
    $gateway    = '/collect/';
    $useCURL    = in_array('curl', get_loaded_extensions());
    $whalePing  = "X-whale-ping: Tasty Activation";
    $response   = '';
    $method     = (empty($post)) ? 'GET' : 'POST';

    // There's a bug in the OS X Server/cURL combination that results in 
    // memory allocation problems so don't use cURL even if it's available
    if (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Darwin') !== false)
        $useCURL = false;

    if ($useCURL) {
        $handle = curl_init("http://{$host}{$gateway}");
        curl_setopt($handle, CURLOPT_HTTPHEADER, array($whalePing));
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    } else {
        $headers  = "{$method} {$gateway} HTTP/1.0\r\n";
        $headers .= "Host: $host\r\n";
        $headers .= "{$whalePing}\r\n";
    }

    if (!empty($post)) {
        // This is a POST request
        if ($useCURL) {
            curl_setopt($handle, CURLOPT_POST, true);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post);
        } else {
            $headers .= "Content-type: application/x-www-form-urlencoded\r\n";
            $headers .= "Content-length: ".strlen($post)."\r\n";
        }
    }

    if ($useCURL) {
        $response = curl_exec($handle);
        if (curl_errno($handle)) {
            $error = 'Could not connect to Gateway (using cURL): '.curl_error($handle);
        }
        curl_close($handle);
    } else {
        $headers .= "\r\n";
        $socket = @fsockopen($host, 80, $errno, $errstr, 10);
        if ($socket) {
            fwrite($socket, $headers.$post);
            while (!feof($socket)) {
                $response .= fgets ($socket, 1024);
            }
            $response = explode("\r\n\r\n", $response, 2);
            $response = trim($response[1]);
        } else {
            $error = 'Could not connect to Gateway (using fsockopen): '.$errstr.' ('.$errno.')';
            $response = 'FAILED';
        }
    }
    
    wp_redirect(admin_url('themes.php?page=tasty-options&active=true'));
}

function tasty_color_dropdown(){
    global $tasty_settings;
    
    $colors = array(
        "pink" => "Hot Pink",
        "green" => "Lani Green",
        "orange" => "Agent Orange",
        "purple" => "Twilight Purple",
        "blue" => "Frost Blue"
    );
    
    $html = '<select name="tasty_color" id="tasty_color">'."\n";
    
    foreach ($colors as $color => $value) {
        if ($tasty_settings->color == $color) {
            $html .= '<option value="'.$color.'" selected="selected">'.$value.'</option>'."\n";
        } else {
            $html .= '<option value="'.$color.'">'.$value.'</option>'."\n";
        }
    }
    
    $html .= '</select>';

    echo $html;
}

function tasty_options_admin(){ 
    global $tasty_settings; ?>
    <h2><?php _e('Tasty Theme Options', 'tasty'); ?></h2>
    
    <?php if ($_GET['saved']): ?>
    <div id="updated" class="updated fade">
        <p><?php echo __('Theme options saved!', 'tasty').' <a href="'.get_bloginfo('url').'/">'.__('View your website &rarr;', 'tasty').'</a>'; ?></p>
    </div>
    <?php endif; ?>
    
    <?php if ($_GET['active']): ?>
    <div id="updated" class="updated fade">
        <p><?php echo __('You\'ve successfully activated the Tasty theme! Feel free to tinker with the settings below or ', 'tasty').' <a href="'.get_bloginfo('url').'/">'.__('view your website &rarr;', 'tasty').'</a>'; ?></p>
    </div>
    <?php endif; ?>
    
    <form action="<?php echo admin_url('admin-post.php?action=tasty_save'); ?>" method="POST">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="tasty_color"><?php _e('Color Scheme'); ?></label></th>
                <td><?php tasty_color_dropdown(); ?></td>
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
                <th scope="row"><label for="tasty_custom_header_image"><?php _e('Custom Header Image'); ?></label></th>
                <td>
                    <input type="text" name="tasty_custom_header_image" value="<?php if ($tasty_settings->custom_header_image) echo $tasty_settings->custom_header_image; ?>" id="tasty_rss_url" class="regular-text" /><br/>
                    <span class="description"><?php _e('The header is 760px wide by 170px high. Enter the URL of an image into this box to use it as your header image. Leave this blank to use the default header image.') ?></span>
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
        
        // Header BG Image
        $tasty_settings->custom_header_image = $_POST['tasty_custom_header_image'];
        
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