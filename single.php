<?php get_header(); ?>

<article class="post">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>

      <h1 class="post-title"><?php the_title(); ?></h1>

      <div class="post-meta">
        <span>📅 <?php echo get_the_date(); ?></span> |
        <span>📂 <?php the_category(', '); ?></span> |
        <span>🏷️ <?php the_tags('', ', ', ''); ?></span>
      </div>

      <?php if (has_post_thumbnail()): ?>
        <div class="post-image">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <!-- Tabla de contenidos -->
      <div class="toc">
        <h2>📑 Tabla de Contenidos</h2>
        <ul id="toc-list"></ul>
      </div>

      <!-- Contenido del post -->
      <div class="post-content">
        <?php the_content(); ?>
      </div>

    <?php endwhile; endif; ?>
</article>

<?php
// Después del loop: endwhile; endif;
$prev_post = get_previous_post(); // Cambia a get_previous_post(true) si quieres sólo de la misma categoría
$next_post = get_next_post();     // Cambia a get_next_post(true) si quieres sólo de la misma categoría

if ($prev_post || $next_post): ?>
  <nav class="post-navigation" aria-label="<?php esc_attr_e('Navegación entre entradas', 'pirublog'); ?>">
    <div class="nav-links">
      <?php if ($prev_post): ?>
        <div class="nav-previous">
          <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
            « <?php echo esc_html(get_the_title($prev_post->ID)); ?>
          </a>
        </div>
      <?php endif; ?>

      <?php if ($next_post): ?>
        <div class="nav-next">
          <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
            <?php echo esc_html(get_the_title($next_post->ID)); ?> »
          </a>
        </div>
      <?php endif; ?>
    </div>
  </nav>
<?php endif; ?>

<!-- Publicaciones relacionadas -->
<div class="related">
  <h3>📌 Publicaciones Relacionadas</h3>
  <ul>
    <?php
    $related = get_posts([
      'category__in' => wp_get_post_categories(get_the_ID()),
      'numberposts'  => 5,
      'post__not_in' => [get_the_ID()]
    ]);
    foreach ($related as $post):
      setup_postdata($post); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endforeach;
    wp_reset_postdata(); ?>
  </ul>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const toc = document.querySelector(".toc");
    const tocList = document.getElementById("toc-list");
    if (!tocList || !toc) return;

    // Buscar todos los encabezados del h1 al h6 dentro de .post-content
    const headings = document.querySelectorAll(
      ".post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6"
    );

    // Si no hay encabezados, ocultamos la tabla de contenidos
    if (headings.length === 0) {
      toc.style.display = "none";
      return;
    }

    headings.forEach((heading, index) => {
      // Si el heading no tiene id, le asignamos uno
      if (!heading.id) {
        heading.id = "section-" + index;
      }

      const li = document.createElement("li");
      const a = document.createElement("a");
      a.href = "#" + heading.id;
      a.textContent = heading.textContent;

      // Ajustar sangría según el nivel (h1=0em, h2=1em, h3=2em, etc.)
      const level = parseInt(heading.tagName.replace("H", ""), 10);
      li.style.marginLeft = (level - 1) * 1.5 + "em";

      li.appendChild(a);
      tocList.appendChild(li);
    });
  });

</script>

<?php get_footer(); ?>