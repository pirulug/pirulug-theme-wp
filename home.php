<?php get_header(); ?>

  <div class="path-indicator">
    <span class="user">root</span><span class="at">@</span><span class="host">server</span>:<span class="dir">~/todos_los_articulos</span>$ ls -la
  </div>

  <div class="header-actions">
      <h1>📝 Archivo de Artículos</h1>
      
      <form role="search" method="get" class="terminal-form compact" action="<?php echo esc_url(home_url('/')); ?>">
        <label>
          <span class="prompt">grep search:</span>
          <input type="search" class="search-field" placeholder="..." value="<?php echo get_search_query(); ?>" name="s" />
        </label>
        <button type="submit" class="search-submit">EXEC</button>
      </form>
  </div>

  <div class="section">
    <?php if (have_posts()): ?>
      
      <ul class="post-list">
        <?php while (have_posts()): the_post(); ?>
          <li>
            <span class="date">[<?php the_time('d/m/Y'); ?>]</span> 
            
            <span class="perms mobile-hide">-rw-r--r--</span>
            
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php endwhile; ?>
      </ul>

      <div class="pagination-wrapper">
        <?php
        the_posts_pagination([
          'mid_size'  => 2,
          'prev_text' => __('[ < PREV ]', 'pirublog'),
          'next_text' => __('[ NEXT > ]', 'pirublog'),
          'screen_reader_text' => 'Navegación de artículos'
        ]);
        ?>
      </div>

    <?php else: ?>
      <div class="empty-state">
        <p>> Error: Directory is empty.</p>
        <p>> 0 files found.</p>
      </div>
    <?php endif; ?>
  </div>



<?php get_footer(); ?>