<?php get_header(); ?>

<div class="section">
  <h1>🔍 Resultados de búsqueda</h1>

  <!-- Formulario de búsqueda (para refinar búsqueda) -->
  <form role="search" method="get" class="search-form terminal-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
      <span class="prompt">$</span>
      <input type="search" class="search-field" placeholder="Escribe tu búsqueda y presiona Enter..."
        value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">↵</button>
  </form>

  <!-- Mostrar el término buscado -->
  <?php if (get_search_query()): ?>
    <p>Mostrando resultados para: <strong><?php echo esc_html(get_search_query()); ?></strong></p>
  <?php endif; ?>

  <!-- Resultados -->
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
    <p>No se encontraron resultados para <strong><?php echo esc_html(get_search_query()); ?></strong>.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>