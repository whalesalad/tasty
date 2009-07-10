<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

include('functions.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&bull;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<?php tasty_styles(); ?>
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css" type="text/css" media="screen"><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" type="text/css" media="screen"><![endif]-->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/tasty.js" type="text/javascript"></script>

<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
    $('.headerOverlay').click(function() {
        window.location = '<?php bloginfo('url'); ?>'; return false;
    });
});
/* ]]> */
</script>

<?php wp_head(); ?>
</head>
<body <?php tasty_body_class(); ?>>
    <div id="wrapper">
        <div class="innerTop"></div>
        <div id="header">
            <?php if (!$tasty_settings->header_text): ?>
                <h1><?php bloginfo('name'); ?></h1>
                <h2><?php bloginfo('description'); ?></h2>
            <?php endif; ?>
            <?php if (!$tasty_settings->header_search): ?>
            <div class="search">
                <form action="." method="get">
                <label class="span" for="searchInput">Search the site...</label>
                <input type="text" name="s" value="<?php echo $_GET["s"]; ?>" id="searchInput" />
                <input type="image" name="submit" src="<?php bloginfo('stylesheet_directory'); ?>/img/searchButton.png" id="submitSearch" />
                </form>
            </div>
            <?php endif; ?>
            <div class="headerOverlay"></div>
        </div>
            