<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

get_header(); ?>
<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="postMeta">
                <div class="date"><span class="month">Jun</span> <span class="day">4</span></div>
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <small>Posted at <?php the_time('g:i A') ?> &bull; <a href="#respond"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></a></small>
            </div>
            
            <div class="postContent">
                <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
            </div>
        </div>
        
    <?php comments_template(); ?>
    <?php endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
