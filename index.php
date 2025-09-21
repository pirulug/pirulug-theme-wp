<?php get_header(); ?>

<!-- Bienvenida -->
<div class="welcome">
  <h1><?php echo esc_html(get_theme_mod('pirublog_welcome_title', 'El Blog de Pirulug')); ?></h1>
  <p><?php echo wp_kses_post(get_theme_mod('pirublog_welcome_text')); ?></p>
</div>


<!-- Artículos -->
<div class="section">
  <h2>📝 Artículos Recientes</h2>
  <ul class="post-list">
    <?php if (have_posts()):
      while (have_posts()):
        the_post(); ?>
        <li><?php the_time('d/m/Y'); ?> — <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endwhile; endif; ?>
  </ul>
  <p>→ <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Ver todos los artículos</a></p>
</div>

<!-- Enlaces -->
<!-- <div class="section">
  <h2>🔗 Enlaces</h2>
  <nav class="links-menu">
    <?php
    wp_nav_menu([
      'theme_location' => 'links-menu',
      'container'      => false,
      'items_wrap'     => '<ul class="links-list">%3$s</ul>',
    ]);
    ?>
  </nav>
</div> -->

<?php get_footer(); ?>