<?php get_header(); ?>


<?php if (have_posts()):
  while (have_posts()):
    the_post(); ?>

    <div class="path-indicator">
      <span class="user">root</span><span class="at">@</span><span class="host">server</span>:<span
        class="dir">~/posts/<?php echo get_the_ID(); ?></span>$ cat content.md
    </div>

    <article class="post-single">

      <h1 class="post-title"><?php the_title(); ?></h1>

      <div class="post-meta-terminal">
        <div class="meta-row">
          <span class="meta-label">Date:</span> <?php echo get_the_date('Y-m-d H:i:s'); ?>
        </div>
        <div class="meta-row">
          <span class="meta-label">User:</span> <?php the_author(); ?>
        </div>
        <div class="meta-row">
          <span class="meta-label">Dir :</span> <?php the_category(' / '); ?>
        </div>
        <?php if (has_tag()): ?>
          <div class="meta-row">
            <span class="meta-label">Tags:</span> [<?php the_tags('', ', ', ''); ?>]
          </div>
        <?php endif; ?>
      </div>

      <?php if (has_post_thumbnail()): ?>
        <div class="post-image-frame">
          <?php the_post_thumbnail('large'); ?>
          <div class="image-caption">fig.1: <?php the_title(); ?></div>
        </div>
      <?php endif; ?>

      <div class="toc" id="toc-container" style="display:none;">
        <div class="toc-header">>> SYSTEM_REPORT: TABLE OF CONTENTS</div>
        <ul id="toc-list"></ul>
      </div>

      <div class="post-content terminal-text">
        <?php the_content(); ?>
      </div>

    </article>

  <?php endwhile; endif; ?>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();

if ($prev_post || $next_post): ?>
  <div class="navigation-terminal">
    <div class="nav-btn nav-prev">
      <?php if ($prev_post): ?>
        <span class="label">PREV_FILE:</span>
        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
          [ &lt;&lt; <?php echo esc_html(get_the_title($prev_post->ID)); ?> ]
        </a>
      <?php else: ?>
        <span class="disabled">[ NO_PREV_DATA ]</span>
      <?php endif; ?>
    </div>

    <div class="nav-btn nav-next">
      <?php if ($next_post): ?>
        <span class="label">NEXT_FILE:</span>
        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
          [ <?php echo esc_html(get_the_title($next_post->ID)); ?> &gt;&gt; ]
        </a>
      <?php else: ?>
        <span class="disabled">[ EOF ]</span>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

<div class="related-terminal">
  <h3>>> LINKED_FILES (Related)</h3>
  <ul class="file-list">
    <?php
    $related = get_posts([
      'category__in' => wp_get_post_categories(get_the_ID()),
      'numberposts'  => 3,
      'post__not_in' => [get_the_ID()]
    ]);
    if ($related):
      foreach ($related as $post):
        setup_postdata($post); ?>
        <li>
          <span class="perms">-r--r--r--</span>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
      <?php endforeach;
      wp_reset_postdata();
    else: ?>
      <li>No linked files found.</li>
    <?php endif; ?>
  </ul>
</div>

<div class="comments-terminal">
  <div class="terminal-header">
    >> SYSTEM_LOGS: USER_INPUT_HISTORY
  </div>

  <?php
  // Si los comentarios están abiertos o hay al menos uno
  if (comments_open() || get_comments_number()):
    comments_template();
  endif;
  ?>
</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    const tocContainer = document.getElementById("toc-container");
    const tocList = document.getElementById("toc-list");
    const headings = document.querySelectorAll(".post-content h2, .post-content h3");

    if (headings.length > 0 && tocList) {
      tocContainer.style.display = "block"; // Mostrar solo si hay items

      headings.forEach((heading, index) => {
        if (!heading.id) heading.id = "section-" + index;

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + heading.id;
        a.textContent = heading.textContent;

        // Sangría visual con caracteres
        if (heading.tagName === "H3") {
          a.textContent = "  |_ " + heading.textContent;
        }

        li.appendChild(a);
        tocList.appendChild(li);
      });
    }
  });
</script>

<?php get_footer(); ?>