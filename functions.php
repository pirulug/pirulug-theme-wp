<?php

function pirublog_enqueue_assets() {
    wp_enqueue_style('pirublog-style', get_stylesheet_uri()); // style.css principal
    wp_enqueue_style('pirublog-custom', get_template_directory_uri() . '/assets/css/style.css', [], '1.0');
    wp_enqueue_script('pirublog-script', get_template_directory_uri() . '/assets/js/script.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'pirublog_enqueue_assets');

register_nav_menus([
    'main-menu'  => __('Menú Principal', 'pirublog'),
    'links-menu' => __('Menú de Enlaces', 'pirublog'),
]);

function pirublog_setup() {
    // Soporte para thumbnails (imágenes destacadas)
    add_theme_support('post-thumbnails');

    // Tamaños por defecto de WordPress
    set_post_thumbnail_size(800, 400, true); // ancho, alto, recorte

    // Tamaños adicionales personalizados
    add_image_size('pirublog-small', 300, 200, true);
    add_image_size('pirublog-large', 1200, 600, true);

    // Soporte para título en el header <title>
    add_theme_support('title-tag');

    // Menú principal
    register_nav_menus([
        'main-menu' => __('Menú Principal', 'pirublog'),
    ]);
}
add_action('after_setup_theme', 'pirublog_setup');

// WELCOME
function pirublog_customize_register($wp_customize) {
    // Sección "Bienvenida"
    $wp_customize->add_section('pirublog_welcome_section', [
        'title'       => __('Sección de Bienvenida', 'pirublog'),
        'priority'    => 30,
        'description' => __('Edita el título y texto de la bienvenida en la portada.', 'pirublog'),
    ]);

    // Campo: Título
    $wp_customize->add_setting('pirublog_welcome_title', [
        'default'           => 'El Blog de Pirulug',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage', // 👈 necesario para live refresh
    ]);

    $wp_customize->add_control('pirublog_welcome_title', [
        'label'   => __('Título', 'pirublog'),
        'section' => 'pirublog_welcome_section',
        'type'    => 'text',
    ]);

    // Campo: Texto
    $wp_customize->add_setting('pirublog_welcome_text', [
        'default'           => '¡Hola! Bienvenid@ a mi rincón en la red. Aquí comparto artículos, notas y experimentos sobre GNU/Linux, software libre, servidores y más.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage', // 👈 necesario para live refresh
    ]);

    $wp_customize->add_control('pirublog_welcome_text', [
        'label'   => __('Texto de bienvenida', 'pirublog'),
        'section' => 'pirublog_welcome_section',
        'type'    => 'textarea',
    ]);

    // 👇 Selective Refresh: lápiz ✏️
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('pirublog_welcome_title', [
            'selector'        => '.welcome h1',
            'render_callback' => function () {
                return esc_html(get_theme_mod('pirublog_welcome_title', 'El Blog de Pirulug'));
            },
        ]);

        $wp_customize->selective_refresh->add_partial('pirublog_welcome_text', [
            'selector'        => '.welcome p',
            'render_callback' => function () {
                return wp_kses_post(get_theme_mod('pirublog_welcome_text'));
            },
        ]);
    }
}
add_action('customize_register', 'pirublog_customize_register');

function pirublog_customize_preview_js() {
    wp_enqueue_script(
        'pirublog-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        ['customize-preview'],
        '1.0',
        true
    );
}
add_action('customize_preview_init', 'pirublog_customize_preview_js');
