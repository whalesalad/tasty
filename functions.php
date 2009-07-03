<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

define('TASTY_LIB', TEMPLATEPATH . '/lib');
define('TASTY_STATIC', get_bloginfo('template_url') . '/lib/static');

// Tasty Core
require_once(TASTY_LIB . '/core.php');

// Tasty Settings
require_once(TASTY_LIB . '/settings.php');

// Auto-instantiate the settings
$tasty_settings = new Settings;

// Template Features
require_once(TASTY_LIB . '/template.php');

// Admin Functionality
if (is_admin())
    require_once(TASTY_LIB . '/admin.php');

?>