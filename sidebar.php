<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */
?>
<div id="sidebar">
    <ul>
        <?php
            /* Widgetized sidebar, if you have the plugin installed. */
            if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : 
        ?>
        
        <li>
            <ul class="socialButtons">
                <li class="button rss"><a href="#rss">RSS</a></li>
                <li class="button email"><a href="#email">Email</a></li>
                <li class="button youtube"><a href="#youtube">Youtube</a></li>
                <li class="button twitter"><a href="#twitter">Twitter</a></li>
                <li class="button facebook"><a href="#facebook">Facebook</a></li>
                <li class="button myspace"><a href="#myspace">MySpace</a></li>
                <li class="button flickr"><a href="#flickr">Flickr</a></li>
                <li class="button delicious"><a href="#delicious">Delicious</a></li>
            </ul>
        </li>

        <!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it. -->
        <li><h2>Author</h2>
        <p>A little something about you, the author. Nothing lengthy, just an overview.</p>
        </li>

        <?php if (is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged()) { ?><li>

        <?php /* If this is a 404 page */ if (is_404()) { ?>
        <?php /* If this is a category archive */ } elseif (is_category()) { ?>
        <p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

        <?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
        <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
        for the day <?php the_time('l, F jS, Y'); ?>.</p>

        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
        for <?php the_time('F, Y'); ?>.</p>

        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
        for the year <?php the_time('Y'); ?>.</p>

        <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
        <p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
        for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

        <?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>

        <?php } ?>

        </li> <?php } ?>

        <li><h2>Archives</h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>

        <?php if (is_home() || is_page()) { ?>
            <?php wp_list_bookmarks(); ?>
        <?php } ?>

        <?php endif; ?>
    </ul>
</div>