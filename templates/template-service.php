<?php
/* Template Name: Service */
get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/services-sections'); ?>

    <div class="service-action">
        <a href="<?php echo get_permalink(get_page_by_path('blog')); ?>" class="btn blog-button">Go to Blog</a>
    </div>
    <?php get_template_part('template-parts/content-containers'); ?>
</main>

<?php
get_footer();
?>
