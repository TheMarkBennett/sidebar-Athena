<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function sidebar_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Main Sidebar'),
        'id' => 'main_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );


}
add_action( 'widgets_init', 'sidebar_widgets_init' );


define('__ROOT__', get_stylesheet_directory());
require_once('/includes/includes.php');
