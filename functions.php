<?php

//link to the queries file

require get_template_directory() . '/inc/queries.php';

//creates the menus
function beautytips_menus() {
    //worpress function
    register_nav_menus( array(
        'main-menu' => 'Main Menu'
    ) );
}

//hook
add_action('init', 'beautytips_menus');

// adds stylesheets and js files

function beautytips_scripts() {

    //Normalize CSS
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1');

    //google font
    wp_enqueue_style('googlefont', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,800;1,700&family=Raleway&family=Staatliches&display=swap', array(), '1.0.0');

    // Slicknav CSS
    wp_enqueue_style('slicknavcss', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.10'); 

    if( basename( get_page_template() ) === 'gallery.php'):
        // Lightbox css
        wp_enqueue_style('lightboxcss', get_template_directory_uri() . '/css/lightbox.min.css', array(), '2.3.11');
    endif;

        // bx slider
    if(is_front_page()):
        wp_enqueue_style('bxsliderscss', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', array(),'4.2.12');
    endif;

    // Main Stylesheet
    wp_enqueue_style('style', get_stylesheet_uri(), array( 'normalize', 'googlefont'), '1.0.0');

    wp_enqueue_script('jquery');

    // Load Javascript Files 
    wp_enqueue_script('slicknavjs', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '1.0.10', true);

    if( basename( get_page_template() ) === 'gallery.php'):
        wp_enqueue_script('lightboxjs', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), '1.3.11', true);
    endif;

    // bx slider
    if(is_front_page()):
        wp_enqueue_script('bxslidersjs', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'),'4.2.12', true);
    endif;

    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'beautytips_scripts');

// Enable Features images and other stuff

function beautytips_setup() {

    //register new image size
    add_image_size( 'square', 350, 350, true);
    add_image_size( 'portrait', 350, 724, true);
    add_image_size( 'box', 400, 375, true);
    add_image_size( 'mediumSize', 700, 400, true);
    add_image_size( 'blog', 966, 644, true);

    //add features image
    add_theme_support('post-thumbnails');

    // SEO Titles
    add_theme_support('title-tag');

}

add_action('after_setup_theme', 'beautytips_setup'); //when the theme is activate and ready!

//Create a Widget Zone
function beautytips_widgets() {
    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="widget">', 
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-primary">',
        'after_title' => '</h3>'

    ) );

}

add_action('widgets_init', 'beautytips_widgets');


/** Displays the Hero image on background of the front-page **/
function beautytips_hero_image() {
    $front_page_id = get_option('page_on_front');
    $image_id = get_field('hero_image', $front_page_id);

    $image = $image_id['url'];

    // Create a "FALSE" stylesheet
    wp_register_style('custom', false);
    wp_enqueue_style('custom');

    $featured_image_css = "
        body.home .site-header {
            background-image: linear-gradient( rgba(0,0,0, 0.5), rgba(0,0,0, 0.5) ), url( $image );  
        }
    ";
    wp_add_inline_style('custom', $featured_image_css);
}
add_action('init', 'beautytips_hero_image');