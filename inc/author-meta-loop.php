<?php
/**
 * Custom author meta functionality for Gioca Giue 10 (Loop version)
 *
 * @package Gioca_Giue_10
 */




// If the Co-Authors Plus plugin is enabled
if ( function_exists( 'coauthors_posts_links' ) ) :

	$coauthors = get_coauthors();

	foreach ( $coauthors as $coauthor ) :

		if ( 'guest-author' == $coauthor->type ) : ?>

			<span class="guest icon-gamepad vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<?php echo $coauthor->display_name . ' <i>(' . __( 'Blasonato Ospite', 'gg10' ) . ')</i>'; ?>
				<span class="fn" itemprop="name">
					<?php echo $coauthor->display_name; ?>
				</span>
				<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $coauthor->ID, 'thumbnail' ); ?>" />
			</span>

		<?php else : ?>

			<a href="<?php echo get_author_posts_url( $coauthor->ID ) ?>" title="<?php echo __( 'Visualizza tutti gli articoli di', 'gg10' ) . ' ' . $coauthor->display_name;  ?>" class="icon-gamepad vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<?php echo $coauthor->display_name; ?>
				<span class="fn" itemprop="name">
					<?php echo $coauthor->display_name; ?>
				</span>
				<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $coauthor->ID, 'thumbnail' ); ?>" />
			</a>

		<?php endif;

	endforeach;

else :

	$author = get_userdata( get_the_author_meta( 'ID' ) );

	?>

	<a href="<?php echo get_author_posts_url( $author->ID ) ?>" title="<?php echo __( 'Visualizza tutti gli articoli di', 'gg10' ) . ' ' . $author->display_name;  ?>" class="icon-gamepad vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<?php echo $author->display_name; ?>
		<span class="fn" itemprop="name">
			<?php echo $author->display_name; ?>
		</span>
		<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $author->ID, 'thumbnail' ); ?>" />
	</a>

	<?php
	
endif;
