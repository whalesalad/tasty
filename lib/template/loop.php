<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
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
    <div class="postContent">
        <?php the_content('Read the rest of this entry &raquo;'); ?>
    </div>
</div>