<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>
<div id="content" class="narrowcolumn">
    <?php if (have_posts()): ?>
        <div class="notice">Search Results for "<?php echo $_GET["s"]; ?>":</div>
        <?php while (have_posts()): the_post(); ?>
            <?php include(TASTY_LIB.'/template/loop.php'); ?>
        <?php endwhile; ?>
        <?php tasty_pagination(); ?>
    <?php else: ?>
        <div class="page" id="postNotFound">
            <div class="postMeta">
                <h2><a href="#">No Posts Found</a></h2>
            </div>
            <div class="postContent">
                <p class="notice">Sorry, no posts were found.</p>
                <?php get_search_form(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php tasty_footer(); ?>