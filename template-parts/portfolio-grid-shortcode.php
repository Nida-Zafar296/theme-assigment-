<?php
// Set default number of posts to display
$num_posts = 6;
if (isset($atts['num_posts'])) {
    $num_posts = intval($atts['num_posts']); //intval convert a value to integer
}
?>

<div class="heading-container">
    <div class="heading-button-row">
        <p>D'SIGN IS THE SOUL</p>
        <a href="<?php echo get_permalink(get_page_by_path('portfolio')); ?>" class="view-all-button">View All</a>
    </div>
    <hr class="section-divider">
</div>

<?php
// Query for posts with featured images
$args = array(
    'posts_per_page' => $num_posts,
    'meta_key' => '_thumbnail_id', 
);

$portfolio_query = new WP_Query($args);

// Loop through the posts and display featured images
if ($portfolio_query->have_posts()):
    echo '<div class="portfolio-grid">';
    while ($portfolio_query->have_posts()):
        $portfolio_query->the_post();
        ?>
        <div class="portfolio-item">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>
        <?php
    endwhile;
    echo '</div>';
else:
    echo '<p>No posts found.</p>';
endif;

// Reset Post Data
wp_reset_postdata();

?>

<hr class="section-divider">
<?php get_template_part('template-parts/content-containers'); ?>