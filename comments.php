<?php
/**
 * The Gioca Giue 10 custom template for displaying comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Gioca_Giue_10
 */



/**
 * Custom Gioca Giue 10 comment function.
 *
 * @param object $comment Database fields of the comment.
 * @param array $args Argument of the comment.
 * @param int $depth Maximum reply depth.
 */
function gg10_comments ($comment, $args, $depth) {

	if ( '' === $comment->comment_type ) : ?>

		<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemscope itemtype="http://schema.org/Comment">

			<header>

				<?php echo gg10_get_avatar( $comment, 30 ); ?>

				<cite class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">

					<?php comment_author_link(); ?>

					<span class="fn" itemprop="name">
						<?php echo get_comment_author( 'c' ); ?>
					</span>

					<meta itemprop="url" content="<?php echo get_comment_author_url(); ?>" />

					<meta itemprop="image" content="<?php echo gg10_get_avatar_src( $comment, 150 ); ?>" />

				</cite>

				<time class="date updated icon-date" datetime="<?php comment_time( 'c' ); ?>" pubdate="pubdate" itemprop="datePublished">
					<?php echo get_comment_date() . ' &middot; ' . get_comment_time(); ?>
				</time>

				<a class="comment-url icon-link" href="<?php comment_link() ?>" itemprop="url"></a>

				<?php
					if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) :
						echo ' <a href="' . get_edit_comment_link() . '" class="edit icon-wrench"></a>';
					endif;
				?>

			</header>

			<div class="comment-body" itemprop="text">

				<?php if ( 0 == $comment->comment_approved ) : ?>

					<strong>
						<?php _e( 'Il commento &egrave; in attesa di approvazione da parte dello staff.', 'gg10' ); ?>
					</strong>

				<?php else : ?>

					<?php // Show comment quotable content ?>
					<div class="quotable">
						<?php comment_text(); ?>
					</div>

					<?php
						// Show custom quote button
						echo '<a href="#" class="quote" data-comment="comment-'
							. get_comment_ID() . '" data-author="'
							. get_comment_author() . '">'
							. __( 'Controquerela', 'gg10' )
							. ' <span class="icon-controquerela"></a>';

						// Show original quote button, not displayed
						comment_reply_link( array_merge( $args, array(
								'add_below'		=> 'comment',
								'reply_text'	=> __( 'Controquerela', 'gg10' ) . ' <span class="icon-controquerela"></span>',
								'depth'			=> $depth,
								'max_depth'		=> $args['max_depth']
							)
						) );
					?>

				<?php endif; ?>

			</div>

		</article>

	<?php else : // Show pingbacks and trackbacks ?>

		<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p>
				<?php
					_e( 'Pingback', 'gg10' );
					echo ': ';
					comment_author_link();
					if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) :
						echo ' <a href="' . get_edit_comment_link() . '" class="edit icon-wrench"></a>';
					endif;
				?>
			</p>
		</div>

	<?php endif;

}




/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h1 class="comments-title">
			<?php
				// Show comment count
				$comments_count = get_comments_number();
				if ( $comments_count == 1 ) :
					echo '1 ' . __( 'querela', 'gg10' );
				else :
					echo $comments_count . ' ' . __( 'querele', 'gg10' );
				endif;
			?>
		</h1>

		<?php
			// Use custom Gioca Giue 10 comment function
			wp_list_comments( array( 'callback' => 'gg10_comments' ) );
		?>

	<?php else : ?>

		<h1 class="comments-title">
			<?php _e( 'Nessuna querela', 'gg10' ); ?> :(
		</h1>

	<?php endif; // have_comments() ?>

	<?php
		// Show the comment form
		comment_form( array(
			'title_reply'		=> __( 'Sporgi querela!', 'gg10' ),
			'title_reply_to'	=> __( 'Querela', 'gg10' ) . ' %s',
			'cancel_reply_link'	=> __( 'Ritira la controquerela', 'gg10' ) . ' :(',
			'label_submit'		=> __( 'Minaccia la querela', 'gg10' ),
		) );
	?>

</section>
