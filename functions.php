<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

define('WS_VERSION', 1.3);
define('WS_THEME', 'Tasty');
define('WS_SLUG', 'tasty');

define('TASTY_LIB', TEMPLATEPATH.'/lib');
define('TASTY_STATIC', get_bloginfo('template_url').'/lib/static');

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