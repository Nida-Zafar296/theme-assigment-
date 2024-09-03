<?php
/* Template Name: Blog Page */
get_header();
?>

<main>
    <div class="custom-blog-content">
        <?php get_template_part('template-parts/services-sections'); ?>
        <h2>LET'S BLOG</h2>
        <hr class="section-divider">
        
        <div class="content-container">
            <div class="content-main">
                <?php
                // Define custom query parameters
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
                );
                
                // Create custom query
                $custom_query = new WP_Query($args);

                // Check if there are posts
                if ($custom_query->have_posts()) :
                    $post_counter = 0; // Initialize post counter
                    while ($custom_query->have_posts()) : $custom_query->the_post();
                        $post_date = get_the_date('d M Y'); // Get the post date
                        
                        // Retrieve categories
                        $categories = get_the_category();
                        $category_list = '';
                        $i = 0; // Category index
                        foreach ($categories as $category) {
                            // Apply background color based on category index
                            $background_class = ($i === 1) ? 'category-title-orange' : 'category-title-black';
                            $category_list .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="' . $background_class . '">' . esc_html($category->name) . '</a>';
                            if ($i < count($categories) - 1) {
                                $category_list .= ', ';
                            }
                            $i++;
                        }
                        if (empty($categories)) {
                            $category_list = 'Uncategorized'; 
                        }

                        // Get comment count
                        $comments_count = get_comments_number();
                        $comments_text = $comments_count === 1 ? 'Comment' : 'Comments';
                        $comments_link = '<a href="' . get_comments_link() . '" class="comments-link">' . $comments_count . ' ' . $comments_text . '</a>';

                        // Determine post background color based on position
                        $background_class = ($post_counter % 2 === 0) ? 'post-title-black' : 'post-title-orange';
                        $post_counter++;
                        ?>
                        <article class="post">
                            <div class="post-content">
                                <div class="post-title-container <?php echo $background_class; ?>">
                                    <span class="post-date"><?php echo $post_date; ?></span> 
                                    <div class="vertical-divider"></div>
                                    <h2 class="post-title"><?php the_title(); ?></h2>
                                </div>
                                <div class="post-body">
                                    <div class="post-thumbnail">
                                        <?php 
                                        // Display the featured image if it exists
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('medium');
                                        }
                                        ?>
                                    </div>
                                    <div class="post-meta">
                                        <div class="post-meta-header">
                                            <span class="author-name"><?php the_author(); ?></span> 
                                            <div class="post-date"><?php echo $post_date; ?></div>
                                        </div>
                                        <div class="post-meta-row">
                                            <div class="post-categories">
                                                <?php echo $category_list; ?> 
                                            </div>
                                            <div class="post-comments">
                                                <?php echo $comments_link; ?> 
                                            </div>
                                        </div>
                                        <div class="post-meta-divider"></div>
                                        <div class="post-excerpt">
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;

                    // Display pagination
                    $pagination_args = array(
                        'total'   => $custom_query->max_num_pages,
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                        'end_size'  => 2,
                        'mid_size'  => 1,
                    );
                    
                    echo '<div class="pagination">';
                    echo paginate_links($pagination_args);
                    echo '</div>';

                else :
                    echo '<p>No posts found.</p>';
                endif;

                // Reset post data
                wp_reset_postdata();
                ?>
            </div>

            <!-- Include Sidebar -->
            <?php get_template_part('template-parts/archive'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>