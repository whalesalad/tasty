<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>
<div id="content">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php include(TASTY_LIB.'/template/loop.php'); ?>
        <?php endwhile; ?>
        <?php tasty_pagination(); ?>
    <?php else: ?>
        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>
    <?php endif; ?>
</div>
<?php tasty_footer(); ?>