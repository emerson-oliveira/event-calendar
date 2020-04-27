<?php

/** @package Event Calendar
 *  Template Default 
 */

?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <?php

		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
                get_template_part( 'assets/single-template' );

			}

        } 
        
		?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer();