<?php get_header(); ?>

<div class="section">
  <h1>📝 Todos los Artículos</h1>

  <?php if (have_posts()): ?>
    <ul class="post-list">
      <?php while (have_posts()):
        the_post(); ?>
        <li>
          <?php the_time('d/m/Y'); ?> —
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
      <?php endwhile; ?>
    </ul>

    <!-- Paginación -->
    <div class="pagination">
      <?php
      the_posts_pagination([
        'mid_size'  => 2,
        'prev_text' => __('« Anterior', 'pirublog'),
        'next_text' => __('Siguiente »', 'pirublog'),
      ]);
      ?>
    </div>

  <?php else: ?>
    <p>No se encontraron artículos.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>