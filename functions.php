<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

define('TASTY_LIB', TEMPLATEPATH . '/lib');

// Tasty Core
require_once(TASTY_LIB . '/core.php');

// Tasty Settings
require_once(TASTY_LIB . '/settings.php');

$tasty_settings = new Settings;
$tasty_settings->get_settings();

// Template Features
require_once(TASTY_LIB . '/template.php');

// Admin Functionality
if (is_admin())
    require_once(TASTY_LIB . '/admin.php');

?>