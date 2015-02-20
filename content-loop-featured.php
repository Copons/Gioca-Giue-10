<?php
/**
 * The Gioca Giue 10 template for displaying the featured post in the loop
 *
 * @package Gioca_Giue_10
 */




// Create the code for both the featured image and its thumb

$featured_image = false;

if ( has_post_thumbnail() ) :

	$featured_image = wp_get_attachment_image_src(
		get_post_thumbnail_id( get_the_ID() ),
		'gg-full-width'
	);
	$featured_thumb= wp_get_attachment_image_src(
		get_post_thumbnail_id( get_the_ID() ),
		'thumbnail'
	);

endif;

if ( $featured_image ) :

	$featured_image_background = ' style="background-image: url(' . $featured_image[0] . ')"';
	$featured_image_itemprop = '<meta itemprop="image" content="' . $featured_image[0] . '" /><meta itemprop="thumbnailUrl" content="' . $featured_thumb[0] . '" />';

else :

	$featured_image_background = '';
	$featured_image_itemprop = '';

endif;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured' ); ?> itemscope itemtype="http://schema.org/Article">

	<?php echo $featured_image_itemprop; ?>

	<header<?php echo $featured_image_background; ?>>

		<a href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>">

			<meta itemprop="url" content="<?php the_permalink(); ?>" />

			<?php if ( get_post_meta( get_the_ID(), 'copons_payoff', true ) ) :  // Show the custom Gioca Giue 10 payoff ?>
				<div class="payoff">
					<?php echo get_post_meta( get_the_ID(), 'copons_payoff', true ); ?>
				</div>
			<?php endif; ?>

			<h1 class="entry-title" itemprop="name">
				<?php the_title(); ?>
			</h1>

		</a>

	</header>

	<div class="excerpt" itemprop="description">
		<?php the_excerpt(); ?>
	</div>

	<div class="post-meta">

		<div class="author">
			<?php // Include the author meta information
				require( 'inc/author-meta-loop.php' );
			?>
		</div>

		<time class="date updated icon-date" datetime="<?php echo get_the_date('Y-m-d'); ?>" pubdate="pubdate" itemprop="datePublished">
			<?php echo get_the_date( 'd/m/Y' ); ?>
		</time>

		<div class="category">
			<?php // Show a custom list of categories for this post
				foreach ( get_the_category( ) as $cat ) :
					echo '<a href="' . get_category_link($cat->term_id) .
							'" class="icon-tags" itemprop="articleSection">' . $cat->name . '</a>';
				endforeach;
			?>
		</div>

		<?php
			// Show the link to the comments section
			comments_popup_link(
				' 0',
				' 1',
				' %',
				'comments icon-querela2',
				__( 'Articolo non querelabile', 'gg10' )
			);
			echo '<meta itemprop="interactionCount" content="UserComments:' . get_comments_number() . '" />';
		?>

	</div>

</article>
