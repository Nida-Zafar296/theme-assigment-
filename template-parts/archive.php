<aside class="blog-sidebar">
    <?php if (is_active_sidebar('blog-sidebar')) : ?>
        <?php dynamic_sidebar('blog-sidebar'); ?>
    <?php else : ?>
        <p><?php _e('Portfolio.', 'textdomain'); ?></p>
    <?php endif; ?>
    <hr class="section-divider">

    <!-- Featured Images Section -->
    <div class="featured-images">
        <?php
        // Define custom query parameters
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 6, 
            'orderby'       => 'date',
            'order'         => 'DESC'
        );

        // Create custom query
        $featured_images_query = new WP_Query($args);

        // Check if there are posts
        if ($featured_images_query->have_posts()) :
            while ($featured_images_query->have_posts()) : $featured_images_query->the_post(); ?>
                <div class="featured-image-item">
                    <?php 
                    // Display the featured image if it exists
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium'); 
                    }
                    ?>
                </div>
            <?php endwhile;
        else :
            echo '<p>No featured images found.</p>';
        endif;
        
        // Reset post data
        wp_reset_postdata();
        ?>
    </div>
    <p class="sidebar-paragraph">Popular Posts</p>
    <hr class="section-divider">
    <div class="popular-posts">
        <?php
        // Define custom query parameters for popular posts
        $popular_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3, 
            'orderby'       => 'comment_count', 
            'order'         => 'DESC'
        );

        // Create custom query for popular posts
        $popular_posts_query = new WP_Query($popular_args);
        if ($popular_posts_query->have_posts()) :
            while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post(); ?>
                <div class="popular-post-item">
                    <div class="popular-post-thumbnail">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail'); 
                        }
                        ?>
                    </div>
                    <div class="popular-post-details">
                        <h4 class="popular-post-title"><?php the_title(); ?></h4>
                        <p class="popular-post-meta">
                            <?php echo get_the_date(); ?> | <span class="author-name"><?php the_author(); ?></span>
                        </p>
                    </div>
                </div>
            <?php endwhile;
        else :
            echo '<p>No popular posts found.</p>';
        endif;

        // Reset post data
        wp_reset_postdata();
        ?>
    </div>
    <hr class="section-divider">
    <div class="archive-section">
        <h3 class="archive-title">Archives</h3>
        <ul class="archive-list">
            <?php wp_get_archives(array('type' => 'monthly')); ?>
        </ul>
    </div>
    <hr class="section-divider">
</aside>