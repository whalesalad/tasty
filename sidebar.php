<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */
?>
<div id="sidebar">
    <ul>
        <li>
            <?php new SocialGrid(); ?>
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