<?php get_header(); ?>

<!-- Bienvenida -->
<div class="welcome">
  <h1><?php echo esc_html(get_theme_mod('pirublog_welcome_title', 'El Blog de Pirulug')); ?></h1>
  <p><?php echo wp_kses_post(get_theme_mod('pirublog_welcome_text')); ?></p>
</div>

<!-- Artículos -->
<div class="section">
  <h2>📝 Artículos Recientes</h2>

  <?php
  // Solo mostrar posts, no páginas
  $recent_posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 8, // cantidad de posts a mostrar
  ]);
  ?>

  <ul class="post-list">
    <?php if ($recent_posts->have_posts()): ?>
      <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
        <li>
          <?php the_time('d/m/Y'); ?> —
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <li>No hay artículos recientes.</li>
    <?php endif; ?>
  </ul>

  <p>→ <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
    Ver todos los artículos
  </a></p>
</div>

<?php get_footer(); ?>
