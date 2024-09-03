<?php
get_header(); 
?>
<main id="main-content">
    <div class="content-wrapper">
        <!-- Main Content Area -->
        <div class="main-content-area">
            <?php
            // Start the Loop.
            if (have_posts()) :
                while (have_posts()) : the_post(); 
            ?>

                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <!-- Post Title -->
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <!-- Post Meta: Author, Date, and Comments -->
                    <div class="post-meta">
                        <div class="post-meta-header">
                            <span class="author-name"><?php the_author(); ?></span>
                            <span class="post-date"><?php echo get_the_date(); ?></span> <!-- Display the post date -->
                            <span class="post-comments-count"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></span> <!-- Display the number of comments -->
                        </div>
                    </div>

                    <hr class="section-divider"> <!-- Section divider above the featured image -->
                    
                    <!-- Post Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Post Content -->
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post Tags -->
                    <div class="post-tags">
                        <?php the_tags('<span class="tags-title">TAGS: </span>', ', ', ''); ?>
                    </div>
                    <hr class="section-divider">
                    <p>Comments</p>
                    <hr class="section-divider">
                    
                    <!-- Post Comments Section -->
                    <div class="post-comments">
                        <?php
                        // Display the comments template which includes comments and comment form
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </article>

            <?php 
                endwhile; 
            else : 
            ?>

                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

            <?php
            endif; 
            ?>
        </div>
        
        <!-- Sidebar Area -->
        <div class="sidebar-area">
            <?php get_template_part('template-parts/archive'); ?>
        </div>
    </div>
    <?php get_template_part('template-parts/content-containers'); ?>
</main>

<?php
get_footer(); 
?>



