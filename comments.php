<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!'); ?>

<?php if (!post_password_required()) { ?>
    <div class="commentsMeta">
        <a name="comments"></a>
        <h3><?php comments_number('No Responses', 'One Response', '% Responses' );?></h3>
    </div>
<?php } else { ?>
    <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php return; } ?>

<?php if (have_comments()) : ?>
    <ol class="postComments">
        <?php wp_list_comments('type=comment&callback=tasty_render_comment'); ?>
    </ol>
<?php else : // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

     <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>

    <?php endif; ?>
<?php endif; ?>

<?php if ($post->comment_status == 'open') { ?>

<div class="commentRespond">
    <h3>Leave A Reply</h3>

    <?php if (get_option('comment_registration') && !$user_ID): ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> if you would like to post a comment.</p>
    <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentForm" <?php if ($user_ID){ ?>class="loggedin"<?php } ?>>
        <fieldset class="type a">
        <?php if ($user_ID): ?>
            <p>You're logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
        <?php else : ?>
            <label>
                <span class="label">Name</span>
                <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            </label>
            <label>
                <span class="label">Mail (This won't be published)</span>
                <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            </label>
            <label>
                <span class="label">Website</span>
                <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
            </label>
        <?php endif; ?>
            <label>
                <span class="label">Your Comment</span>
                <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
            </label>
            <p>
                <input name="submit" type="submit" id="submitComment" tabindex="5" value="Submit Comment" />
                <?php comment_id_fields(); ?>
            </p>
            <?php do_action('comment_form', $post->ID); ?>
        </fieldset>
        </form>
    <?php endif;?>
</div>

<?php } ?>
