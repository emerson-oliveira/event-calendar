<?php

/** @package Event Calendar
 *  Template Default 
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">

  <main class="content site-main" role="main">

    <?php

    while (have_posts()) : the_post();

      $imagem   = get_the_post_thumbnail(get_the_ID(), 'medium');
      $imagem_url   = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
      $venue   = (string) post_custom(FILED_PREFIX . 'vn_name');

      echo 'name venue: ' . $venue;
      echo '<br>';
      echo 'url: ' . $imagem_url;
      echo '<br>';
      echo 'imagem: ' . $imagem;

    endwhile  ?>

  </main>

</div>

<?php get_footer(); ?>