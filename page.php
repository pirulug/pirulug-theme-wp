<?php get_header(); ?>

<?php if (have_posts()):
  while (have_posts()):
    the_post(); ?>

    <div class="path-indicator">
      <span class="user">www-data</span><span class="at">@</span><span class="host">node</span>:<span
        class="dir">/var/www/pages/<?php echo $post->post_name; ?>.html</span>$ view
    </div>

    <article id="page-<?php the_ID(); ?>" <?php post_class('page-terminal'); ?>>

      <header class="page-header-terminal">
        <h1 class="page-title"><?php the_title(); ?></h1>

        <div class="page-stats">
          <span class="stat">MODE: <span class="val">READ_ONLY</span></span>
          <span class="stat">SIZE: <span class="val"><?php echo strlen($post->post_content); ?> bytes</span></span>
          <span class="stat">UPDATED: <span class="val"><?php the_modified_date('Y-m-d H:i'); ?></span></span>
        </div>
      </header>

      <div class="post-content terminal-text">
        <?php the_content(); ?>
      </div>

      <?php edit_post_link(
        '>> SUDO NANO EDIT_PAGE',
        '<div class="admin-edit-command">',
        '</div>'
      ); ?>

    </article>

  <?php endwhile; endif; ?>


<?php get_footer(); ?>