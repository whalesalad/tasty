<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */
?>
<div id="sidebar">
    <ul>
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

        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>

        <li><h2>Archives</h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>

        <?php wp_list_bookmarks(); ?>

        <?php endif; ?>
    </ul>
</div>