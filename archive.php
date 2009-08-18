<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

tasty_header(); ?>

<div id="content" class="narrowcolumn">
    <?php if (have_posts()): ?>
    <div class="notice">
    <?php if (is_category()) {
        printf("Archive for the \"%s\" Category", single_cat_title("", false));
    } elseif (is_tag()) {
        printf("Posts Tagged \"%s\"", single_tag_title("", false));
    } elseif (is_day()) {
        the_time('F jS, Y'); echo " Archives";
    } elseif (is_month()) {
        the_time('F Y'); echo " Archives";
    } elseif (is_year()) {
        the_time('Y'); echo " Archives";
    } elseif (is_author()) {
        echo "Author Archive";
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        echo "Blog Archives";
    } ?>
    </div>

    <?php while (have_posts()): the_post(); ?>
        <?php include(TASTY_LIB.'/template/loop.php'); ?>
    <?php endwhile; ?>

    <?php tasty_pagination(); ?>
    
    <?php else:
        if (is_category()) {
            printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
        } else if (is_date()) {
            echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
        } else if (is_author()) {
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
        } else {
            echo("<h2 class='center'>No posts found.</h2>");
        }
        get_search_form();

    endif; ?>
</div>
<?php tasty_footer(); ?>