<?php get_header(); ?>

  <div class="path-indicator">
    <span class="user">guest</span><span class="at">@</span><span class="host">blog</span>:<span class="dir">/bin/search</span>$ query -v "<?php echo get_search_query(); ?>"
  </div>

  <div class="search-header">
      <form role="search" method="get" class="terminal-form" action="<?php echo esc_url(home_url('/')); ?>">
        <label>
          <span class="prompt">grep:</span>
          <input type="search" class="search-field" placeholder="Nueva búsqueda..." value="<?php echo get_search_query(); ?>" name="s" />
        </label>
        <button type="submit" class="search-submit">RUN</button>
      </form>
  </div>

  <div class="search-status">
    <?php 
    global $wp_query;
    $total_results = $wp_query->found_posts;
    ?>
    
    <?php if ($total_results > 0): ?>
        <span class="status-success">>> PROCESS_ID: "<?php echo esc_html(get_search_query()); ?>" | FOUND: <?php echo $total_results; ?> files.</span>
    <?php else: ?>
        <span class="status-error">>> FATAL_ERROR: Term "<?php echo esc_html(get_search_query()); ?>" yielded 0 results.</span>
    <?php endif; ?>
  </div>

  <div class="section">
    <?php if (have_posts()): ?>
      
      <ul class="post-list">
        <?php while (have_posts()): the_post(); ?>
          <li>
            <span class="date">[<?php the_time('Y-m-d'); ?>]</span>
            
            <span class="perms mobile-hide">
                <?php echo (get_post_type() === 'page') ? 'd-rwxr-x' : '-rw-r--r--'; ?>
            </span>
            
            <a href="<?php the_permalink(); ?>">
                <?php 
                    $title = get_the_title();
                    $keys = explode(" ", get_search_query());
                    $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="highlight">$0</strong>', $title);
                    echo $title;
                ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>

      <div class="pagination-wrapper">
        <?php
        the_posts_pagination([
          'mid_size'  => 2,
          'prev_text' => __('[ < PREV ]', 'pirublog'),
          'next_text' => __('[ NEXT > ]', 'pirublog'),
        ]);
        ?>
      </div>

    <?php else: ?>
      
      <div class="empty-state-terminal">
        <p>bash: <?php echo esc_html(get_search_query()); ?>: command not found</p>
        <br>
        <p>Suggestions:</p>
        <ul>
            <li>Check your spelling.</li>
            <li>Try standard keywords.</li>
            <li>Run 'ls -la' (Home) to see all files.</li>
        </ul>
        <br>
        <p><a href="<?php echo home_url(); ?>">[ Return to Root Directory ]</a></p>
      </div>

    <?php endif; ?>
  </div>


<?php get_footer(); ?>