<?php

// Include pages and categories in search results
function include_pages_and_categories_in_search($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post', 'page'));
    }
    return $query;
}
add_filter('pre_get_posts', 'include_pages_and_categories_in_search');

// Register the blog sidebar
function my_theme_register_sidebars() {
    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'textdomain'),
        'id'            => 'blog-sidebar',
        'description'   => __('A sidebar for the blog page.', 'textdomain'),
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'my_theme_register_sidebars');

// Theme setup: 
function wp_theme_assignment_setup() {
    // Register navigation menus
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu', 'wp-theme-assignment' ),
            'footer-menu'  => __( 'Footer Menu', 'wp-theme-assignment' ),
        )
    );

    // Add support for featured images
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 ); 
}
add_action( 'after_setup_theme', 'wp_theme_assignment_setup' );

// Enqueue theme styles
function wp_theme_assignment_enqueue_scripts() {
    wp_enqueue_style( 'wp-theme-assignment-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wp_theme_assignment_enqueue_scripts' );

// Shortcode for portfolio grid
function wp_blog_theme_portfolio_grid($atts) {
    $atts = shortcode_atts(array('num_posts' => 6), $atts, 'portfolio_grid');

    ob_start();

    $args = array(
        'posts_per_page' => intval($atts['num_posts']),
        'meta_key' => '_thumbnail_id',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="posts-grid">';
        $post_count = 0;

        while ($query->have_posts()) {
            $query->the_post();

            if ($post_count % 3 === 0) {
                if ($post_count > 0) {
                    echo '</div>';
                }
                echo '<div class="posts-row">';
            }

            ?>
            <div class="post-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                    <h2><?php the_title(); ?></h2>
                </a>
            </div>
            <?php

            $post_count++;
        }

        echo '</div></div>';
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('portfolio_grid', 'wp_blog_theme_portfolio_grid');
add_theme_support('pagination');

// Custom comment format
function custom_comment_format($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <b class="fn"><?php comment_author(); ?></b>
                    <time datetime="<?php comment_time('c'); ?>">
                        <?php printf(__(' %1$s at %2$s', 'textdomain'), get_comment_date(), get_comment_time()); ?>
                    </time>
                </div>
            </footer>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
        </article>
    </li>
    <?php
}

// Retrieve post content by ID
function get_post_content_by_id($post_id) {
    $post = get_post($post_id);
    if ($post) {
        return apply_filters('the_content', $post->post_content);
    }
    return '';
}

// Register theme options menu and settings
function register_theme_options_menu() {
    add_menu_page(
        __( 'Theme Options', 'textdomain' ), 
        __( 'Theme Options', 'textdomain' ), 
        'manage_options',                    
        'theme-options',                     
        'display_theme_options_page',       
        '',                                  
        61                                 
    );
}
add_action( 'admin_menu', 'register_theme_options_menu' );

function display_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Theme Options', 'textdomain' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'theme_options_group' );
            do_settings_sections( 'theme-options' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register font style setting
function register_theme_font_setting() {
    register_setting( 'theme_options_group', 'theme_font_style' );

    add_settings_section(
        'theme_font_section',
        __( 'Theme Font Settings', 'textdomain' ),
        'theme_font_section_callback',
        'theme-options'
    );

    add_settings_field(
        'theme_font_style',
        __( 'Font Style', 'textdomain' ),
        'theme_font_style_field_callback',
        'theme-options',
        'theme_font_section'
    );
}
add_action( 'admin_init', 'register_theme_font_setting' );

function theme_font_section_callback() {
    echo __( 'Select the font style for your theme.', 'textdomain' );
}

function theme_font_style_field_callback() {
    $font_style = get_option( 'theme_font_style', 'Arial' );
    ?>
    <select name="theme_font_style">
        <option value="Arial" <?php selected( $font_style, 'Arial' ); ?>>Arial</option>
        <option value="Verdana" <?php selected( $font_style, 'Verdana' ); ?>>Verdana</option>
        <option value="Times New Roman" <?php selected( $font_style, 'Times New Roman' ); ?>>Times New Roman</option>
        <option value="Georgia" <?php selected( $font_style, 'Georgia' ); ?>>Georgia</option>
        <option value="Courier New" <?php selected( $font_style, 'Courier New' ); ?>>Courier New</option>
    </select>
    <?php
}

// Register color picker settings
function register_theme_color_settings() {
    register_setting( 'theme_options_group', 'header_background_color' );
    register_setting( 'theme_options_group', 'footer_background_color' );

    add_settings_section(
        'theme_color_section',
        __( 'Header and Footer Background Colors', 'textdomain' ),
        'theme_color_section_callback',
        'theme-options'
    );

    add_settings_field(
        'header_background_color',
        __( 'Header Background Color', 'textdomain' ),
        'header_background_color_field_callback',
        'theme-options',
        'theme_color_section'
    );

    add_settings_field(
        'footer_background_color',
        __( 'Footer Background Color', 'textdomain' ),
        'footer_background_color_field_callback',
        'theme-options',
        'theme_color_section'
    );
}
add_action( 'admin_init', 'register_theme_color_settings' );

function theme_color_section_callback() {
    echo __( 'Select background colors for the header and footer.', 'textdomain' );
}

function header_background_color_field_callback() {
    $header_color = get_option( 'header_background_color', '#ffffff' );
    ?>
    <input type="text" name="header_background_color" value="<?php echo esc_attr( $header_color ); ?>" class="wp-color-picker-field" data-default-color="#ffffff">
    <?php
}

function footer_background_color_field_callback() {
    $footer_color = get_option( 'footer_background_color', '#ffffff' );
    ?>
    <input type="text" name="footer_background_color" value="<?php echo esc_attr( $footer_color ); ?>" class="wp-color-picker-field" data-default-color="#ffffff">
    <?php
}

// Enqueue color picker scripts and styles
function enqueue_color_picker( $hook_suffix ) {
    if ( 'toplevel_page_theme-options' !== $hook_suffix ) {
        return;
    }

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'theme-options-script',
        get_template_directory_uri() . '/js/theme-options.js',
        array( 'wp-color-picker' ),
        false,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'enqueue_color_picker' );


