<?php
/**
 * Custom author meta functionality for Gioca Giue 10 (Single post footer version)
 *
 * @package Gioca_Giue_10
 */




// If the Co-Authors Plus plugin is enabled
if ( function_exists( 'coauthors_posts_links' ) ) :

	$coauthors = get_coauthors();

	if ( count($coauthors) == 1 ) :
		echo '<p class="intro">' . __( 'Avete letto un articolo del Blasonato', 'gg10' ) . ':</p>';
	else :
		echo '<p class="intro">' . __( 'Avete letto un articolo dei Blasonati', 'gg10' ) . ':</p>';
	endif;

	foreach ( $coauthors as $coauthor ) : ?>

		<div class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">

			<?php echo gg10_get_avatar( $coauthor->ID, 150 ); ?>

			<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $coauthor->ID, 'thumbnail' ) ?>" />

			<h3 class="fn" itemprop="name">
				<?php if ( 'guest-author' == $coauthor->type ) :
					echo $coauthor->display_name . ' <i>(' . __( 'Blasonato Ospite', 'gg10' ) . ')</i>';
				?>
				<?php else :
					echo '<a href="' . get_author_posts_url($coauthor->ID) . '" title="' . __( 'Visualizza tutti gli articoli di', 'gg10' ) . ' ' . $coauthor->display_name . '">' . $coauthor->display_name . '</a>';
				endif; ?>
			</h3>

			<?php
				if ( $coauthor->description ) :
					echo '<p>' . str_replace("\n", '<br />', $coauthor->description) . '</p>';
				endif;
			?>

			<div class="post-meta">

				<?php
					if ( $coauthor->user_url != '' )
						echo '<a href="' . $coauthor->user_url . '" target="_blank" class="icon-link social" itemprop="url"></a>';

					if ( $coauthor->facebook != '' )
						echo '<a href="' . $coauthor->facebook . '" target="_blank" class="icon-facebook social"></a>';

					if ( $coauthor->twitter != '' )
						echo '<a href="https://twitter.com/' . $coauthor->twitter . '" target="_blank" class="icon-twitter social"></a>';

					if ( $coauthor->google != '' || $coauthor->googleplus != '' ) :
						if ( $coauthor->google != '' ) :
							$google_author_link = $coauthor->google;
						elseif ( $POST->author->googleplus != '' ) :
							$google_author_link = $coauthor->googleplus;
						endif;
						echo '<a href="' . $google_author_link . '?rel=author" target="_blank" class="icon-google-plus2 social"></a>';
					endif;

					if ( $coauthor->steam != '' )
						echo '<a href="http://steamcommunity.com/id/' . $coauthor->steam . '" target="_blank" class="icon-steam social"></a>';

					if ( $coauthor->xbl != '' )
						echo '<span class="xbox social">XBL: ' . $coauthor->xbl . '</span>';

					if ( $coauthor->psn != '' )
						echo '<span class="playstation social">PSN: ' . $coauthor->psn . '</span>';
				?>

			</div>

		</div>

	<?php endforeach;

// If the Co-Authors Plus plugin is NOT enabled
else : ?>

	<div class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">';

		<p class="intro">
			<?php _e( 'Avete letto un articolo del Blasonato', 'gg10' ); ?>:
		</p>

		<?php echo gg10_get_avatar( $author->ID, 'thumbnail' ); ?>

		<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $author->ID, 'thumbnail' ) ?>" />

		<h3 class="fn" itemprop="name">
			<?php if ( $author->type == 'guest-author' ) :
				echo $author->display_name . ' <i>(' . __( 'Blasonato Ospite', 'gg10' ) . ')</i>';
			?>
			<?php else :
				echo '<a href="' . get_author_posts_url($author->ID) . '" title="' . __( 'Visualizza tutti gli articoli di', 'gg10' ) . ' ' . $author->display_name . '">' . $author->display_name . ' <i>(' . __( 'Blasonato Ospite', 'gg10' ) . ')</i></a>';
			endif; ?>
		</h3>

		<?php
			if ( $author->description ) :
				echo '<p>' . str_replace("\n", '<br />', $author->description) . '</p>';
			endif;
		?>

		<div class="post-meta">

			<?php
				if ( $author->user_url != '' )
					echo '<a href="' . $author->user_url . '" target="_blank" class="icon-link social" itemprop="url"></a>';

				if ( $author->facebook != '' )
					echo '<a href="' . $author->facebook . '" target="_blank" class="icon-facebook social"></a>';

				if ( $author->twitter != '' )
					echo '<a href="https://twitter.com/' . $author->twitter . '" target="_blank" class="icon-twitter social"></a>';

				if ( $author->google != '' || $author->googleplus != '' ) :
					if ( $author->google != '' ) :
						$google_author_link = $author->google;
					elseif ( $POST->author->googleplus != '' ) :
						$google_author_link = $author->googleplus;
					endif;
					echo '<a href="' . $google_author_link . '?rel=author" target="_blank" class="icon-google-plus2 social"></a>';
				endif;

				if ( $author->steam != '' )
					echo '<a href="http://steamcommunity.com/id/' . $author->steam . '" target="_blank" class="icon-steam social"></a>';

				if ( $author->xbl != '' )
					echo '<span class="xbox social">XBL: ' . $author->xbl . '</span>';

				if ( $author->psn != '' )
					echo '<span class="playstation social">PSN: ' . $author->psn . '</span>';
			?>

		</div>

	</div>

<?php endif;
