<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

function tasty_render_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; 
    
    // Add unnaproved class to comment if it hasn't been approved yet
    $comment_class_str = '';
    if ($comment->comment_approved == 0)
        $comment_class_str = 'unapproved';
    
    ?>
    <li <?php comment_class($comment_class_str); ?> id="comment-<?php comment_ID(); ?>">
        <div class="commentBody"><?php
            if ($comment->comment_approved){
                comment_text();
            } else {
                echo 'Your comment is awaiting moderation.';
            }
        ?>
        </div>
        <div class="commentMeta">
            <span class="authorStar">&#10029;</span>
            <a href="<?php comment_author_url() ?>"><?php comment_author() ?></a> on <?php comment_date() ?> at <?php comment_time() ?>.
        </div>
<?php } ?>