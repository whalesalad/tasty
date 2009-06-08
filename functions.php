<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

function tastycomment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="commentBody"><?php comment_text() ?></div>
        <div class="commentMeta">
            <a href="<?php comment_author_url() ?>"><?php comment_author() ?></a> on <?php comment_date() ?> at <?php comment_time() ?>.
        </div>
<?php } ?>