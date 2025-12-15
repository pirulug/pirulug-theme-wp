<?php get_header(); ?>

<div class="welcome-terminal">
  <div class="terminal-header-bar">
    <span class="dot red"></span>
    <span class="dot yellow"></span>
    <span class="dot green"></span>
    <span class="title-bar">user@pirublog: ~ (zsh)</span>
  </div>

  <div class="welcome-content">
    <h1><?php echo esc_html(get_theme_mod('pirublog_welcome_title', '>> INICIANDO SISTEMA...')); ?></h1>
    <p class="typing-effect">
      <?php echo wp_kses_post(get_theme_mod('pirublog_welcome_text', 'Cargando módulos del núcleo... Completado.')); ?>
    </p>

    <div class="system-stats">
      <span>UPTIME: 99.9%</span>
      <span>MEM: 64MB/128MB</span>
      <span>LOAD: 0.12, 0.05, 0.01</span>
    </div>
  </div>
</div>

<div class="search-section-front">
  <form role="search" method="get" class="terminal-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
      <span class="prompt">guest@home:~$ search_packet</span>
      <input type="search" class="search-field" placeholder="ingrese comando..."
        value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
    </label>
    <button type="submit" class="search-submit">ENTER</button>
  </form>
</div>

<div class="two-columns">

  <div class="section main-files">
    <h2>>> LS -LA /LATEST_POSTS/</h2>

    <?php
    $recent_posts = new WP_Query([
      'post_type'      => 'post',
      'posts_per_page' => 8,
    ]);
    ?>

    <ul class="post-list">
      <?php if ($recent_posts->have_posts()): ?>
        <?php while ($recent_posts->have_posts()):
          $recent_posts->the_post(); ?>
          <li>
            <span class="date">[<?php the_time('d/m'); ?>]</span>
            <span class="perms mobile-hide">-rw-r--r--</span>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span class="ext mobile-hide">.md</span>
          </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else: ?>
        <li>>> NO_FILES_FOUND.</li>
      <?php endif; ?>
    </ul>

    <div class="view-all-cmd">
      <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
        >> execute /view_all_archives.sh
      </a>
    </div>
  </div>

  <div class="section sidebar-dirs">
    <h2>>> TREE /CATEGORIES/</h2>
    <ul class="dir-list">
      <?php
      $categories = get_categories();
      foreach ($categories as $category) {
        echo '<li><a href="' . get_category_link($category->term_id) . '"><span class="folder-icon">📂</span> ' . $category->name . '/ <span class="count">(' . $category->count . ')</span></a></li>';
      }
      ?>
    </ul>
  </div>

</div>

<?php get_footer(); ?>