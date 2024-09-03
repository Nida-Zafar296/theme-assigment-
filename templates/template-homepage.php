<?php
/* Template Name: Home page */
get_header(); 
?>

<main id="main-content">
    <div class="featured-image-container">
        <?php
        if ( has_post_thumbnail() ) {
            echo '<div class="featured-image">';
            the_post_thumbnail( 'full' ); 
            echo '</div>';
        }
        ?>
        <div class="overlay-content">
            <h1>Gearing up the ideas</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna alique. Ut enim ad minim veniam.</p>
        </div>
    </div>
      <?php get_template_part('template-parts/services-sections'); ?>
      <?php get_template_part('template-parts/portfolio-grid-shortcode'); ?>
    
</main>

<?php
get_footer(); 
?>


