<?php
/* Template Name: Contact */
get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/services-sections'); ?>

    <div class="contact-info">
        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <p>Phone: <a href="tel:+1234567890">+123 456 7890</a></p>
        </div>
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <p>Email: <a href="mailto:contact@example.com">nidazafar006@gmail.com</a></p>
        </div>
    </div>
</main>

<?php
get_footer();
?>
