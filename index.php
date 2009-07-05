<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>
<div id="content">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="postMeta">
                <div class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('j') ?></span></div>
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php tasty_title(); ?> <?php the_title_attribute(); ?>"><?php tasty_title(); ?></a></h2>
                <small>Posted at <?php the_time('g:i A') ?> &bull; <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><?php if ($user_ID) { ?> &bull; <?php edit_post_link('Edit Post'); ?><?php } ?></small>
            </div>
            <div class="postContent">
                <?php the_content('Read the rest of this entry &raquo;'); ?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php tasty_pagination(); ?>
    <?php else : ?>
        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>
    <?php endif; ?>
</div>
<?php tasty_footer(); ?>