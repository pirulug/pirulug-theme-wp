<?php get_header(); ?>

<div class="welcome">
  <h1><?php echo esc_html(get_theme_mod('pirublog_welcome_title', 'El Blog de Pirulug')); ?></h1>
  <p><?php echo wp_kses_post(get_theme_mod('pirublog_welcome_text')); ?></p>
</div>

<div class="search-section">
  <form role="search" method="get" class="terminal-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
      <span class="prompt">visitor@blog:~$ search -q</span>
      <input type="search" 
             class="search-field" 
             placeholder="escribe_aqui..." 
             value="<?php echo get_search_query(); ?>" 
             name="s" 
             autocomplete="off" />
    </label>
    <button type="submit" class="search-submit">ENTER</button>
  </form>
</div>

<div class="section">
  <h2>📝 Artículos Recientes</h2>
  
  <?php if (have_posts()): ?>
    <ul class="post-list">
      <?php while (have_posts()): the_post(); ?>
        <li>
            <span class="date">[<?php the_time('d/m/Y'); ?>]</span> 
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
      <?php endwhile; ?>
    </ul>

    <div class="pagination-link">
       <p>→ <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">cd /todos_los_articulos/</a></p>
    </div>

  <?php else: ?>
    <div class="error-404">
      <p>Error 404: No data found in /posts/ directory.</p>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>