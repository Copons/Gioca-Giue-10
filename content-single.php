<?php
/**
 * The Gioca Giue 10 template for displaying a single post
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

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single' ); ?> itemscope itemtype="http://schema.org/Article">

	<?php if ( $featured_image ) : // Open the featured image div ?>

		<div class="featured-image" style="background-image: url('<?php echo $featured_image[0]; ?>')">

			<img src="<?php echo $featured_image[0]; ?>" class="hidden-image" />
			<meta itemprop="image" content="<?php echo $featured_image[0]; ?>" />
			<meta itemprop="thumbnailUrl" content="<?php echo $featured_image[0]; ?>" />

	<?php endif; ?>

			<header id="start">

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

				<?php if ( $featured_image ) : // Show the arrow to the content ?>

					<div class="previous-arrow" id="gotostart">
						<a href="#start">
							<span class="icon-arrow-down"></span>
						</a>
					</div>

				<?php endif; ?>

				<meta itemprop="description" content="<?php echo wp_strip_all_tags( get_the_excerpt() ); ?>" />

			</header>

	<?php if ( $featured_image ) : // Close the featured image div ?>
		</div>
	<?php endif; ?>

	<div class="post-container">

		<div class="post-meta">

			<div class="author">
				<div class="author-disclaimer">
					<?php _e( 'Un eccellente articolo di', 'gg10' ); ?>
				</div>
				<?php
					// Include the author meta information
					require_once( 'inc/author-meta-post-header.php' );
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
					'0 ' . __( 'Querele', 'gg10' ),
					'1 ' . __( 'Querela', 'gg10' ),
					'% ' . __( 'Querele', 'gg10' ),
					'comments icon-querela2',
					__( 'Articolo non querelabile', 'gg10' )
				);
				echo '<meta itemprop="interactionCount" content="UserComments:' . get_comments_number() . '" />';
			?>

		</div>

		<div class="entry-content post-body" itemprop="articleBody">

			<?php
				the_content();

				if ( is_single() ) :
					// Include the post votes
					require( 'inc/giocagiue-votes.php' );
				endif;
			?>

		</div>

		<div class="post-meta" data-permalink="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>">

			<?php
				// Open connection to SharedCount free API to obtain social information about this post
				$json_social = file_get_contents( "http://free.sharedcount.com/?url=" . rawurlencode( get_permalink() ) . "&apikey=01dab01d061ad7efcaa56ef2309264aefd8194ae" );
				$social = json_decode( $json_social, true);
			?>

			<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook social icon-facebook">
			<?php
				echo $social['Facebook']['total_count'];
				echo '<meta itemprop="interactionCount" content="UserLikes:' . $social['Facebook']['like_count'] . '" />';
			?>
			</a>

			<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=Gioca%20Giu&egrave;%20&middot;%20<?php echo get_the_title(); ?>" class="twitter social icon-twitter">
			<?php
				echo $social['Twitter'];
				echo '<meta itemprop="interactionCount" content="UserTweets:' . $social['Twitter'] . '" />';
			?>
			</a>

			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="googleplus social icon-google-plus">
			<?php
				echo $social['GooglePlusOne'];
				echo '<meta itemprop="interactionCount" content="UserPlusOnes:' . $social['GooglePlusOne'] . '" />';
			?>
			</a>

			<?php
				// Show the link to the comments section
				comments_popup_link(
					'0 ' . __( 'Querele', 'gg10' ),
					'1 ' . __( 'Querela', 'gg10' ),
					'% ' . __( 'Querele', 'gg10' ),
					'comments icon-querela2',
					__( 'Articolo non querelabile', 'gg10' )
				);
			?>

		</div>

		<footer>

			<?php if (has_tag()) : ?>
				<div class="post-tags">
					<?php the_tags('', ''); ?>
				</div>
			<?php endif; ?>

			<div class="post-author">
				<?php
					// Include the author meta information
					require_once( 'inc/author-meta-post-footer.php' );
				?>
			</div>

			<?php if ( is_single() && function_exists( 'related_posts' ) ) : // If it exists, use the related_posts() function ?>
				<div class="post-related">
					<?php related_posts(); ?>
				</div>
			<?php endif; ?>

			<div class="disclaimer">
				<?php _e( 'Il proprietario del blog e gli autori degli articoli dichiarano di non essere responsabili per i commenti inseriti dai lettori che saranno i soli responsabili delle proprie dichiarazioni, secondo le leggi vigenti in Italia. Eventuali commenti, lesivi dell&apos;immagine o dell&apos;onorabilit&agrave; di persone terze, non sono da attribuirsi agli autori, nemmeno se il commento viene espresso in forma anonima o criptata.', 'gg10' ); ?>
			</div>

		</footer>

	</div>

</article>




<?php

// Comments section

if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;




// Next post section

$previous_post = get_previous_post();

if ( ! empty( $previous_post ) ) :
	$post = $previous_post;
	setup_postdata( $post );

	if ( has_post_thumbnail() ) :
		$featured_image = wp_get_attachment_image_src(
			get_post_thumbnail_id( get_the_ID() ),
			'gg-full-width'
		);
		$featured_image_background = ' style="background-image: url(' . $featured_image[0] . ')"';
	else :
		$featured_image_background = '';
	endif;
	?>

	<nav class="previous-post"<?php echo $featured_image_background; ?>>

		<a href="<?php the_permalink(); ?>">

			<div class="previous-arrow">
				<span class="icon-arrow-down"></span>
			</div>
			<div class="payoff">
				<?php _e( 'Prossimo articolo', 'gg10' ); ?>
			</div>
			<h1>
				<?php the_title(); ?>
			</h1>

		</a>

	</nav>

	<?php wp_reset_postdata();
endif;
