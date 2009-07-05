<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>
<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="page" id="page-<?php the_ID(); ?>">
        <div class="postMeta">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php tasty_title(); ?> <?php the_title_attribute(); ?>"><?php tasty_title(); ?></a></h2>
        </div>
        <div class="postContent">
            <?php the_content('Read the rest of this page &raquo;'); ?>
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <?php edit_post_link('[ Edit Page ]', '<p>', '</p>'); ?>
        </div>
    </div>
    <?php endwhile; endif; ?>
</div>
<?php tasty_footer(); ?>