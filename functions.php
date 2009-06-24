<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

define('TASTY_LIB', TEMPLATEPATH . '/lib');

// Tasty Settings
require_once(TASTY_LIB . '/settings.php');

// Template Features
require_once(TASTY_LIB . '/template.php');

// Admin Functionality
if (is_admin())
    require_once(TASTY_LIB . '/admin.php');

?>