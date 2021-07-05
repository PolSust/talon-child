<?php
// style
function theme_enqueue_styles()
{
    wp_enqueue_style("parent-style", get_template_directory_uri() . "/style.css");
    wp_enqueue_style("bx-slider-style", "https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css");
}
add_action("wp_enqueue_scripts", "theme_enqueue_styles");
function theme_enqueue_scripts()
{
    wp_enqueue_script("slideshow", get_stylesheet_directory_uri() . "/js/slideshow.js", array("jquery"));
    wp_enqueue_script("gallery", get_stylesheet_directory_uri() . "/js/porfolioGallery.js", array("jquery"));
    wp_enqueue_script("scroll", get_stylesheet_directory_uri() . "/js/menuAutoScroll.js", array("jquery"));
    wp_enqueue_script("mapsAPI", "https://maps.googleapis.com/maps/api/js?key=" . get_theme_mod("maps_api_key"));
    wp_enqueue_script("bx-slider", "https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js");
}
add_action("wp_enqueue_scripts", "theme_enqueue_scripts");

function talon_child_customize_register($wp_customize)
{
    // slider--------------------------------------------------------------AIzaSyBr2XM7Q8HtzM_LRpvB-sVEP1ffaER4tS8
    $wp_customize->add_section('slider_settings', array(
        'title'      => __('Slideshow', 'talon_child'),
        'priority'   => 30,
    ));
    //slider_active
    $wp_customize->add_setting("slider_active", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "slider_active",
        array(
            'label'     => __('Active', 'talon_child'),
            'type'      => 'checkbox',
            'section'   => 'slider_settings',
            'settings'   => 'slider_active',
        )
    );

    addImage($wp_customize, 4);
    // Google Map----------------------------------------------------------
    $wp_customize->add_section('maps_settings', array(
        'title'      => __('Google Maps', 'talon_child'),
        'priority'   => 30,
    ));
    //maps_active
    $wp_customize->add_setting("maps_api_key", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "maps_api_key",
        array(
            'label'     => __('Your google maps API key:', 'talon_child'),
            'type'      => 'input',
            'section'   => 'maps_settings',
            'settings'   => 'maps_api_key',
        )
    );
    $wp_customize->add_setting("maps_active", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "maps_active",
        array(
            'label'     => __('Display map', 'talon_child'),
            'type'      => 'checkbox',
            'section'   => 'maps_settings',
            'settings'   => 'maps_active',
        )
    );
    $wp_customize->add_setting("latitude", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "latitude",
        array(
            'label'     => __('Latitude:', 'talon_child'),
            'type'      => 'input',
            'section'   => 'maps_settings',
            'settings'   => 'latitude',
        )
    );
    $wp_customize->add_setting("longitude", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "longitude",
        array(
            'label'     => __('Longitude:', 'talon_child'),
            'type'      => 'input',
            'section'   => 'maps_settings',
            'settings'   => 'longitude',
        )
    );
    $wp_customize->add_setting("zoom", array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        "zoom",
        array(
            'label'     => __('Zoom:', 'talon_child'),
            'type'      => 'input',
            'section'   => 'maps_settings',
            'settings'   => 'zoom',
        )
    );
}
add_action('customize_register', 'talon_child_customize_register');

function addImage($wp_customize, $amount)
{
    for ($i = 1; $i < $amount + 1; $i++) {

        $wp_customize->add_setting('header_images' . $i, array(
            'default'   => '',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'slider_image' . $i,
                array(
                    'label'     => __('Image ' . $i, 'talon_child'),
                    'type'      => 'image',
                    'section'   => 'slider_settings',
                    'settings'   => 'header_images' . $i,
                )
            )
        );
    }
}

// contenu perso
function games_post_type()
{
    $labels = array(
        "name" => "Games",
        "all_items" => "Tous les games",
        "singular_name" => "Service"
    );
    $args = array(
        "labels" => $labels,
        "public" => true,
        "show_in_rest" => true,
        "has_archive" => true,
        "supports" => array("title", "editor"),
        "menu_position" => 5,
        "menu_icon" => "dashicons-games"
    );
    register_post_type("games", $args);
    //taxonomy
    $labels_recettes_types = array(

        'name' => "Types de games",

        'new_item_name' => 'Nom du nouveau type de service', 'add_new_item' => 'Ajouter un nouveau type de service',

        'search_items' => 'Rechercher dans les types de games',

        'not_found' => 'Aucun type de recette service'

    );

    $args_types_recettes = array(

        'labels' => $labels_recettes_types,

        'public' => true,

        'show_admin_column' => true,

        'show_in_rest' => true,

        'hierarchical' => true

    );

    // register_taxonomy('typesgames', 'games', $args_types_recettes);
}
add_action("init", "games_post_type");

//footer menu
register_nav_menus(array(
    "principal" => "Menu principal",
    "footer" => "Menu footer",
));
//sidebar

add_action('widgets_init', 'ci_register_sidebar');

function ci_register_sidebar()
{
    register_sidebar(array(
        'name' => 'Footer talon-child sidebar',
        'id' => 'footer-talon-child',
        'description' => 'Talon-child sidebar for the footer',
        'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
