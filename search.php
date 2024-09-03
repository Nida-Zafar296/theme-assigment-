<?php get_header(); ?>

<main id="main-content">
    <div class="search-results-container">
        <?php if ( have_posts() ) : ?>
            <h1>Search Results for: <?php echo get_search_query(); ?></h1>
            <div class="search-results">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="search-result-item">
                        <div class="search-result-image">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('medium'); 
                            }
                            ?>
                        </div>
                        <div class="search-result-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php the_excerpt(); //automatically generates a short summary of the post.  ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'textdomain' ),
                'next_text'          => __( 'Next page', 'textdomain' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>',
            ) );
            ?>

        <?php else : ?>
            <h1>No results found</h1>
            <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>

