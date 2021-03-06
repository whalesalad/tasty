<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>
<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
        <div class="postMeta">
            <?php if ($post->post_type == "post"): ?>
                <div class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('j') ?></span></div>                        
            <?php endif; ?>
                <h2 class="<?php tasty_variable_title(); ?>">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php tasty_title(); ?> <?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            <?php if ($post->post_type == "post"): ?>
                <small>Posted at <?php the_time('g:i A') ?> by <?php the_author() ?> &bull; <a href="<?php the_permalink() ?>#comments"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></a><?php if ($user_ID) { ?> &bull; <?php edit_post_link('Edit Post'); ?><?php } ?></small>
            <?php endif; ?>
        </div>
        <?php /**
        <div class="postMeta">
            <div class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('j') ?></span></div>
            <h2 class="<?php tasty_variable_title(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <small>Posted at <?php the_time('g:i A') ?> &bull; <a href="#comments"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></a> by <?php the_author() ?><?php if ($user_ID) { ?> &bull; <?php edit_post_link('Edit Post'); ?><?php } ?></small>
        </div>
        **/ ?>
        <div class="postContent">
            <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <?php the_tags( '<p><strong>Tagged:</strong> ', ', ', '</p>'); ?>
        </div>
    </div>
    
    <div class="postComments">
        <?php comments_template(); ?>
    </div>

    <?php endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

</div>
<?php tasty_footer(); ?>