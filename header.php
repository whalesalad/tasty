<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

include('functions.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php tasty_stylesheet_url(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/tasty.js" type="text/javascript"></script>

<?php wp_head(); ?>
</head>
<body <?php tasty_body_class(); ?>>
    <?php print_r($tasty_settings); ?>
    <div id="wrapper">
        <div class="innerTop"></div>
        <div id="header">
            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <h2><?php bloginfo('description'); ?></h2>
            <div class="search">
                <label class="span" for="searchInput">Search the site...</label>
                <input type="text" name="search" value="" id="searchInput" />
                <input type="image" name="submit" src="<?php bloginfo('stylesheet_directory'); ?>/img/searchButton.png" id="submitSearch" />
            </div>
        </div>
            