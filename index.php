<?php
/**
 * The Gioca Giue 10 main template file
 *
 * @package Gioca_Giue_10
 */




get_header();




// If it is an archive related page, get its correct header
if ( ! is_front_page() && ! is_home() && ! is_page() && ! is_single() ) :
	get_template_part( 'content', 'archive' );
endif;

?>




<div id="content" class="content" role="main">

	<?php
		// Handle the previous page pagination link
		if ( get_query_var('paged') ) :
			$paged = get_query_var('paged');
		else :
			$paged = 1;
		endif;

		if ( $paged > 1 ) : ?>
			<div class="prev-page">
				<a href="<?php echo esc_url( home_url( '/' ) ) . 'page/' . ( $paged - 1 ); ?>">
					&larr; <?php _e( 'Pagina precedente', 'gg10' ); ?>
				</a>
			</div>
		<?php endif;

		// If it is the first page of the front page, use the featured post template for the first post
		if ( is_front_page() && 1 == $paged ) :

			$featured = new WP_Query( array(
				'category__not_in'		=> $excluded_categories,
				'posts_per_page'		=> 1,
				'post__in'				=> get_option( 'sticky_posts' ),
				'ignore_sticky_posts'	=> 1,
			) );

			while ( $featured->have_posts() ) : $featured->the_post();
				get_template_part( 'content', 'loop-featured' );
			endwhile;

			wp_reset_postdata();

		endif;

		// Continue the loop normally
		if ( have_posts() ) :

			$first_post = true;
			$post_count = 0;

			while ( have_posts() ) : the_post();

				$post_number++;

				// If it is a single page, use the single post template
				if ( is_single() ) :
					get_template_part( 'content', 'single' );
				else :

					// If the first post is in an excluded category, jump to the next iteration of the while
					if ( is_front_page()
						&& 1 == $paged
						&& $first_post
						&& ! in_category( $excluded_categories )
					) :
						$first_post = false;
						continue;
					endif;

					// If everything is finally fine, use the loop post template
					get_template_part( 'content' );

					// If the loop-aside widget is active, use it now
					if ( $post_number == 2 && is_active_sidebar( 'loop-aside' ) ) :
						dynamic_sidebar( 'loop-aside' );
					endif;

				endif;

			endwhile;

		endif;

		// If it is a page, use the single post template
		if ( is_page() ) :
			get_template_part( 'content', 'single' );
		endif;
	?>

</div>




<?php

get_sidebar();
get_footer();
