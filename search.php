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
            <div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
                <div class="postMeta">
                    <?php if ($post->post_type == "post"): ?>
                        <div class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('j') ?></span></div>                        
                    <?php endif; ?>
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php tasty_title(); ?> <?php the_title_attribute(); ?>"><?php tasty_title(); ?></a></h2>
                    <?php if ($post->post_type == "post"): ?>
                        <small>Posted at <?php the_time('g:i A') ?> &bull; <a href="#respond"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></a><?php if ($user_ID) { ?> &bull; <?php edit_post_link('Edit Post'); ?><?php } ?></small>
                    <?php endif; ?>
                </div>

                <div class="postContent">
                    <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                    <?php the_tags( '<p><strong>Tags:</strong> ', ', ', '</p>'); ?>
                </div>
            </div>
        <?php endwhile; ?>
        <?php tasty_pagination(); ?>
    <?php else: ?>
        <div class="notice">No posts found. Try a different search?</div>
        <?php get_search_form(); ?>
    <?php endif; ?>
</div>
<?php tasty_footer(); ?>