<?php
/**
 * Custom votes functionality for Gioca Giue
 *
 * @package Gioca_Giue_10
 */




if ( '' != get_post_meta( $post->ID, 'kmag_vote', TRUE )
	|| '' != get_post_meta( $post->ID, 'pitchfork_vote', TRUE )
	|| '' != get_post_meta( $post->ID, 'cm_vote', TRUE ) ) : ?>

	<aside class="votes">

	<?php
		// VOTO IN SCALA K
		if ( '' != get_post_meta( $post->ID, 'kmag_vote', TRUE ) ) : ?>
			<div class="vote-box vote-box-k-mag">
				<div class="k-mag">
					<div class="vote"><?php echo get_post_meta( $post->ID, 'kmag_vote', TRUE ); ?></div>
					<div class="grades">1 &nbsp;2 &nbsp;3 &nbsp;4 &nbsp;5 &nbsp;6 &nbsp;7 &nbsp;8 &nbsp;9 &nbsp;10</div>
					<div class="bar bar<?php echo get_post_meta( $post->ID, 'kmag_grafica', TRUE ); ?>">G</div><!-- Grafica -->
					<div class="bar bar<?php echo get_post_meta( $post->ID, 'kmag_qi', TRUE ); ?>">QI</div><!-- Impegno Intellettuale -->
					<div class="bar bar<?php echo get_post_meta( $post->ID, 'kmag_sonoro', TRUE ); ?>">A</div><!-- Sonoro -->
					<div class="bar bar<?php echo get_post_meta( $post->ID, 'kmag_k', TRUE ); ?>">FK</div><!-- Fattore K (Divertimento Complessivo) -->
				</div>
			</div>
		<?php endif;

		// VOTO IN SCALA PITCHFORK
		if ( '' != get_post_meta( $post->ID, 'pitchfork_vote', TRUE ) ) : ?>
			<div class="vote-box vote-box-pitchfork">
				<div class="pitchfork">
					<div><?php echo get_post_meta( $post->ID, 'pitchfork_vote', TRUE ); ?></div>
				</div>
			</div>
		<?php endif;

		// VOTO IN SCALA CONSOLEMANIA
		if ( '' != get_post_meta( $post->ID, 'cm_vote', TRUE ) ) : ?>
			<div class="vote-box vote-box-consolemania">
				<table class="consolemania">
					<tr>
						<td class="header" colspan="2"><h4><?php echo get_post_meta( $post->ID, 'cm_piattaforma', TRUE ); ?></h4></td>
					</tr>
					<tr>
						<td class="left"><h4>GRAFICA</h4>
							<?php
							if ( '' != get_post_meta( $post->ID, 'cm_grafica1', TRUE) ) :
								echo get_post_meta( $post->ID, 'cm_grafica1', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_grafica2', TRUE) ) :
								echo get_post_meta( $post->ID, 'cm_grafica2', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_grafica3', TRUE) ) :
								echo get_post_meta( $post->ID, 'cm_grafica3', TRUE ) . '<br />';
							endif;
							?></td>
						<td class="right"><?php echo get_post_meta( $post->ID, 'cm_grafica_voto', TRUE ); ?></td>
					</tr>
					<tr>
						<td class="left"><h4>SONORO</h4>
							<?php
							if ( '' != get_post_meta( $post->ID, 'cm_sonoro1', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_sonoro1', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_sonoro2', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_sonoro2', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_sonoro3', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_sonoro3', TRUE ) . '<br />';
							endif;
							?>
						</td>
						<td class="right"><?php echo get_post_meta( $post->ID, 'cm_sonoro_voto', TRUE ); ?></td>
					</tr>
					<tr>
						<td class="left"><h4>GIOCABILIT&Agrave;</h4>
							<?php
							if ( '' != get_post_meta( $post->ID, 'cm_gioc1', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_gioc1', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_gioc2', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_gioc2', TRUE ) . '<br />';
							endif;
							if ( '' != get_post_meta( $post->ID, 'cm_gioc3', TRUE ) ) :
								echo get_post_meta( $post->ID, 'cm_gioc3', TRUE ) . '<br />';
							endif;
							?>
						</td>
						<td class="right"><?php echo get_post_meta( $post->ID, 'cm_gioc_voto', TRUE ); ?></td>
					</tr>
					<tr>
						<td class="footer"><h4><?php echo get_post_meta( $post->ID, 'cm_sviluppatore', TRUE ); ?></h4></td>
						<td class="right vote"><?php echo get_post_meta( $post->ID, 'cm_vote', TRUE ); ?></td>
					</tr>
				</table>
			</div>
		<?php endif; ?>

	</aside>
<?php endif;
