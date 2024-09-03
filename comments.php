<?php
if (have_comments()) :
    ?>
    <div id="comments" class="comments-area">
     <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true, //this parameter shortens the pingback comment output
                'callback'    => 'custom_comment_format' // Custom callback function
            ));
            ?>
        </ol>

        <?php
        // Display comment navigation (if applicable)
        the_comments_navigation();

        // Display comment form
        ?>
        <div class="comment-form-wrapper">
            <?php comment_form(); ?>
        </div>
    </div>
<?php
endif;

