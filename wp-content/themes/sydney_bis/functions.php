<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme        = wp_get_theme();
    wp_enqueue_style( $parenthandle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get( 'Version' )
    );
    wp_enqueue_style( 'child-style',
        get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get( 'Version' ) // This only works if you have Version defined in the style header.
    );
}

// Hook pour le menu avec le lien Admin
add_filter('wp_nav_menu_items','add_admin_link', 10, 2);
function add_admin_link( $items, $args ) {
    // est-ce que l'utilisateur est bien connecté ?
    if (is_user_logged_in()) {
        //si oui, on affiche le lien admin
       $items .= '<li><a href="'. get_admin_url() .'">Admin</a></li>';
    }
   return $items;
}
?>

