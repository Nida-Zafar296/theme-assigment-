<div class="recent-posts-section">
    <?php
      // Get the current page number
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

      // Determine the number of posts per page based on the current page
      $posts_per_page = ($paged === 1) ? -1 : 3; // -1 means no limit for the first page
  
      $args = array(
          'post_type'      => 'post',
          'posts_per_page' => 6,
          'paged'          => $paged,
      );
  
      $recent_posts_query = new WP_Query($args);
    

    if ($recent_posts_query->have_posts()) :
        echo '<div class="recent-posts-grid">';
        
        // Display the posts
        while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post(); ?>
            <div class="recent-post-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endwhile;
        
        echo '</div>';
       

        $pagination_args = array(
            'total'   => $recent_posts_query->max_num_pages,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'end_size'  => 2,
            'mid_size'  => 1,
        );
        
        $pagination = paginate_links($pagination_args);
        
        echo '<div class="pagination">';
        echo $pagination ? $pagination : '<p>No pagination links generated.</p>';
        echo '</div>';
        

    else :
        echo '<p>No recent posts available.</p>';
    endif;

    // Reset post data
    wp_reset_postdata();
    ?>
</div>

<hr class="section-divider">



