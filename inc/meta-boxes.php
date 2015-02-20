<?php
/**
 * Custom meta boxes for Gioca Giue 10
 *
 * @package Gioca_Giue_10
 */




add_action( 'add_meta_boxes', 'copons_payoff_add' );

function copons_payoff_add() {
	add_meta_box(
		'copons_payoff_box',
		__( 'Payoff', 'gg10' ),
		'copons_payoff_callback',
		'post',
		'side',
		'default'
	);
}

function copons_payoff_callback( $post ) {
	wp_nonce_field( 'copons_payoff_save', 'copons_payoff_nonce' );
	$values = get_post_custom( $post->ID );
	$payoff = isset( $values['copons_payoff'] ) ? esc_attr( $values['copons_payoff'][0] ) : '';
	?>
	<p>
		<label for="copons_payoff">Payoff:</label>
		<input id="copons_payoff" name="copons_payoff" type="text" value="<?php echo $payoff; ?>" />
	</p>
	<?php
}

add_action('save_post', 'copons_payoff_save');

function copons_payoff_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
		return;
	endif;
	if ( ! isset( $_POST['copons_payoff_nonce'] ) || ! wp_verify_nonce( $_POST['copons_payoff_nonce'], 'copons_payoff_save' ) ) :
		return;
	endif;
	if ( ! current_user_can( 'edit_post' ) ) :
		return;
	endif;
	if ( isset( $_POST['copons_payoff'] ) ) :
		update_post_meta( $post_id, 'copons_payoff', wp_kses( $_POST['copons_payoff'], array() )
		);
	endif;
}







add_action( 'add_meta_boxes', 'copons_votes_cm' );

function copons_votes_cm() {
	add_meta_box(
		'votes_cm',
		__( 'Voto in scala Consolemania', 'gg10' ),
		'copons_votes_cm_callback',
		'post',
		'normal',
		'high'
	);
}

function copons_votes_cm_callback( $post ) {
	wp_nonce_field( 'copons_votes_cm_save', 'copons_votes_cm_nonce' );
	$cmpiattaforma = get_post_meta( $post->ID, 'cm_piattaforma', true );
	$cmg1 = get_post_meta( $post->ID, 'cm_grafica1', true );
	$cmg2 = get_post_meta( $post->ID, 'cm_grafica2', true );
	$cmg3 = get_post_meta( $post->ID, 'cm_grafica3', true );
	$cmgv = get_post_meta( $post->ID, 'cm_grafica_voto', true );
	$cms1 = get_post_meta( $post->ID, 'cm_sonoro1', true );
	$cms2 = get_post_meta( $post->ID, 'cm_sonoro2', true );
	$cms3 = get_post_meta( $post->ID, 'cm_sonoro3', true );
	$cmsv = get_post_meta( $post->ID, 'cm_sonoro_voto', true );
	$cmp1 = get_post_meta( $post->ID, 'cm_gioc1', true );
	$cmp2 = get_post_meta( $post->ID, 'cm_gioc2', true );
	$cmp3 = get_post_meta( $post->ID, 'cm_gioc3', true );
	$cmpv = get_post_meta( $post->ID, 'cm_gioc_voto', true );
	$cmsviluppatore = get_post_meta( $post->ID, 'cm_sviluppatore', true );
	$cmvote = get_post_meta( $post->ID, 'cm_vote', true );
	?>
	<p>
		<label>
			<?php _e( 'Grafica', 'gg10' ); ?>: <em><?php _e( '(+ o -)', 'gg10' ); ?></em></label><br />
		<input type="text" id="cm_grafica1" name="cm_grafica1" class="widefat" value="<?php echo $cmg1; ?>" maxlength="255" />
		<input type="text" id="cm_grafica2" name="cm_grafica2" class="widefat" value="<?php echo $cmg2; ?>" maxlength="255" />
		<input type="text" id="cm_grafica3" name="cm_grafica3" class="widefat" value="<?php echo $cmg3; ?>" maxlength="255" />
		<label for="cm_grafica_voto"><?php _e( 'Voto', 'gg10' ); ?>:</label>
		<select id="cm_grafica_voto" name="cm_grafica_voto">
			<option value=""></option>
			<?php for ( $i = 0; $i <= 100; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $cmgv ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label><?php _e( 'Sonoro', 'gg10' ); ?>: <em><?php _e( '(+ o -)', 'gg10' ); ?></em></label><br />
		<input type="text" id="cm_sonoro1" name="cm_sonoro1" class="widefat" value="<?php echo $cms1; ?>" maxlength="255" />
		<input type="text" id="cm_sonoro2" name="cm_sonoro2" class="widefat" value="<?php echo $cms2; ?>" maxlength="255" />
		<input type="text" id="cm_sonoro3" name="cm_sonoro3" class="widefat" value="<?php echo $cms3; ?>" maxlength="255" />
		<label for="cm_sonoro_voto"><?php _e( 'Voto', 'gg10' ); ?>:</label>
		<select id="cm_sonoro_voto" name="cm_sonoro_voto">
			<option value=""></option>
			<?php for ( $i = 0; $i <= 100; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $cmsv ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label><?php _e( 'Giocabilit&agrave;', 'gg10' ); ?>: <em><?php _e( '(+ o -)', 'gg10' ); ?></em></label><br />
		<input type="text" id="cm_gioc1" name="cm_gioc1" class="widefat" value="<?php echo $cmp1; ?>" maxlength="255" />
		<input type="text" id="cm_gioc2" name="cm_gioc2" class="widefat" value="<?php echo $cmp2; ?>" maxlength="255" />
		<input type="text" id="cm_gioc3" name="cm_gioc3" class="widefat" value="<?php echo $cmp3; ?>" maxlength="255" />
		<label for="cm_gioc_voto"><?php _e( 'Voto', 'gg10' ); ?>:</label>
		<select id="cm_gioc_voto" name="cm_gioc_voto">
			<option value=""></option>
			<?php for ( $i = 0; $i <= 100; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $cmpv ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label for="cm_piattaforma"><?php _e( 'Piattaforma', 'gg10' ); ?>:</label><br />
		<input type="text" id="cm_piattaforma" name="cm_piattaforma" class="widefat" value="<?php echo $cmpiattaforma; ?>" maxlength="255" />
	</p>
	<p>
		<label for="cm_sviluppatore"><?php _e( 'Sviluppatore', 'gg10' ); ?>:</label><br />
		<input type="text" id="cm_sviluppatore" name="cm_sviluppatore" class="widefat" value="<?php echo $cmsviluppatore; ?>" maxlength="255" />
	</p>
	<p>
		<label for="cm_vote"><?php _e( 'Voto Totale', 'gg10' ); ?>:</label>
		<select id="cm_vote" name="cm_vote">
			<option value=""></option>
			<?php for ( $i = 0; $i <= 100; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $cmvote ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<?php
}

add_action( 'save_post', 'copons_votes_cm_save' );

function copons_votes_cm_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
		return;
	endif;
	if ( ! isset( $_POST['copons_votes_cm_nonce'] ) || ! wp_verify_nonce( $_POST['copons_votes_cm_nonce'], 'copons_votes_cm_save' ) ) :
		return;
	endif;
	if ( ! current_user_can( 'edit_post' ) ) :
		return;
	endif;
	if ( isset( $_POST['cm_piattaforma'] ) ) :
		update_post_meta( $post_id, 'cm_piattaforma', $_POST['cm_piattaforma'] );
	endif;
	if ( isset( $_POST['cm_grafica1'] ) ) :
		update_post_meta( $post_id, 'cm_grafica1', $_POST['cm_grafica1'] );
	endif;
	if ( isset( $_POST['cm_grafica2'] ) ) :
		update_post_meta( $post_id, 'cm_grafica2', $_POST['cm_grafica2'] );
	endif;
	if ( isset( $_POST['cm_grafica3'] ) ) :
		update_post_meta( $post_id, 'cm_grafica3', $_POST['cm_grafica3'] );
	endif;
	if ( isset( $_POST['cm_grafica_voto'] ) ) :
		update_post_meta( $post_id, 'cm_grafica_voto', $_POST['cm_grafica_voto'] );
	endif;
	if ( isset( $_POST['cm_sonoro1'] ) ) :
		update_post_meta( $post_id, 'cm_sonoro1', $_POST['cm_sonoro1'] );
	endif;
	if ( isset( $_POST['cm_sonoro2'] ) ) :
		update_post_meta( $post_id, 'cm_sonoro2', $_POST['cm_sonoro2'] );
	endif;
	if ( isset( $_POST['cm_sonoro3'] ) ) :
		update_post_meta( $post_id, 'cm_sonoro3', $_POST['cm_sonoro3'] );
	endif;
	if ( isset( $_POST['cm_sonoro_voto'] ) ) :
		update_post_meta( $post_id, 'cm_sonoro_voto', $_POST['cm_sonoro_voto'] );
	endif;
	if ( isset( $_POST['cm_gioc1'] ) ) :
		update_post_meta( $post_id, 'cm_gioc1', $_POST['cm_gioc1'] );
	endif;
	if ( isset( $_POST['cm_gioc2'] ) ) :
		update_post_meta( $post_id, 'cm_gioc2', $_POST['cm_gioc2'] );
	endif;
	if ( isset( $_POST['cm_gioc3'] ) ) :
		update_post_meta( $post_id, 'cm_gioc3', $_POST['cm_gioc3'] );
	endif;
	if ( isset( $_POST['cm_gioc_voto'] ) ) :
		update_post_meta( $post_id, 'cm_gioc_voto', $_POST['cm_gioc_voto'] );
	endif;
	if ( isset( $_POST['cm_sviluppatore'] ) ) :
		update_post_meta( $post_id, 'cm_sviluppatore', $_POST['cm_sviluppatore'] );
	endif;
	if ( isset( $_POST['cm_vote'] ) ) :
		update_post_meta( $post_id, 'cm_vote', $_POST['cm_vote'] );
	endif;
}







add_action( 'add_meta_boxes', 'copons_votes_kmag' );

function copons_votes_kmag() {
	add_meta_box(
		'votes_kmag',
		__( 'Voto in scala K', 'gg10' ),
		'copons_votes_kmag_callback',
		'post',
		'normal',
		'high'
	);
}

function copons_votes_kmag_callback( $post ) {
	wp_nonce_field( 'copons_votes_kmag_save', 'copons_votes_kmag_nonce' );
	$kgrafica = get_post_meta( $post->ID, 'kmag_grafica', true );
	$kqi = get_post_meta( $post->ID, 'kmag_qi', true );
	$ksonoro = get_post_meta( $post->ID, 'kmag_sonoro', true );
	$kfattorek = get_post_meta( $post->ID, 'kmag_k', true );
	$kvote = get_post_meta( $post->ID, 'kmag_vote', true );
	?>
	<p>
		<label for="kmag_grafica"><?php _e( 'Voto Grafica', 'gg10' ); ?>:</label>
		<select id="kmag_grafica" name="kmag_grafica">
			<option value=""></option>
			<?php for ( $i = 1; $i <= 10; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $kgrafica ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label for="kmag_qi"><?php _e( 'Voto QI', 'gg10' ); ?>:</label>
		<select id="kmag_qi" name="kmag_qi">
			<option value=""></option>
			<?php for ( $i = 1; $i <= 10; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $kqi ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label for="kmag_sonoro"><?php _e( 'Voto Sonoro', 'gg10' ); ?>:</label>
		<select id="kmag_sonoro" name="kmag_sonoro">
			<option value=""></option>
			<?php for ( $i = 1; $i <= 10; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $ksonoro ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label for="kmag_k"><?php _e( 'Voto Fattore K', 'gg10' ); ?>:</label>
		<select id="kmag_k" name="kmag_k">
			<option value=""></option>
			<?php for ( $i = 1; $i <= 10; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $kfattorek ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<p>
		<label for="kmag_vote"><?php _e( 'Voto Totale', 'gg10' ); ?>:</label>
		<select id="kmag_vote" name="kmag_vote">
			<option value=""></option>
			<?php for ( $i = 1; $i <= 1000; $i++ ) : ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $kvote ); ?>>
					<?php echo $i; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<?php
}

add_action( 'save_post', 'copons_votes_kmag_save' );

function copons_votes_kmag_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
		return;
	endif;
	if ( ! isset( $_POST['copons_votes_kmag_nonce'] ) || ! wp_verify_nonce( $_POST['copons_votes_kmag_nonce'], 'copons_votes_kmag_save') ) :
		return;
	endif;
	if ( ! current_user_can( 'edit_post' ) ) :
		return;
	endif;
	if ( isset( $_POST['kmag_grafica'] ) ) :
		update_post_meta( $post_id, 'kmag_grafica', $_POST['kmag_grafica'] );
	endif;
	if ( isset( $_POST['kmag_qi'] ) ) :
		update_post_meta( $post_id, 'kmag_qi', $_POST['kmag_qi'] );
	endif;
	if ( isset( $_POST['kmag_sonoro'] ) ) :
		update_post_meta( $post_id, 'kmag_sonoro', $_POST['kmag_sonoro'] );
	endif;
	if ( isset( $_POST['kmag_k'] ) ) :
		update_post_meta( $post_id, 'kmag_k', $_POST['kmag_k'] );
	endif;
	if ( isset( $_POST['kmag_vote'] ) ) :
		update_post_meta( $post_id, 'kmag_vote', $_POST['kmag_vote'] );
	endif;
}







add_action( 'add_meta_boxes', 'copons_votes_pitchfork' );

function copons_votes_pitchfork() {
	add_meta_box(
		'votes_pitchfork',
		__( 'Voto in scala Pitchfork', 'gg10' ),
		'copons_votes_pitchfork_callback',
		'post',
		'normal',
		'high'
	);
}

function copons_votes_pitchfork_callback( $post ) {
	wp_nonce_field( 'copons_votes_pitchfork_save', 'copons_votes_pitchfork_nonce' );
	$pfvote = get_post_meta( $post->ID, 'pitchfork_vote', true );
	?>
	<p>
		<label for="pitchfork_vote"><?php _e( 'Voto', 'gg10' ); ?>:</label>
		<select id="pitchfork_vote" name="pitchfork_vote">
			<option value=""></option>
			<?php for ( $i = 0.0; $i <= 10.0; $i = $i + 0.1 ) :
				$value = number_format( $i, 1 );
			?>
				<option value="<?php echo $value; ?>" <?php selected( $value, $pfvote ); ?>>
					<?php echo $value; ?>
				</option>
			<?php endfor; ?>
		</select>
	</p>
	<?php
}

add_action( 'save_post', 'copons_votes_pitchfork_save' );

function copons_votes_pitchfork_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
		return;
	endif;
	if ( ! isset( $_POST['copons_votes_pitchfork_nonce']) || ! wp_verify_nonce( $_POST['copons_votes_pitchfork_nonce'], 'copons_votes_pitchfork_save' ) ) :
		return;
	endif;
	if ( ! current_user_can( 'edit_post' ) ) :
		return;
	endif;
	if ( isset( $_POST['pitchfork_vote'] ) ) :
		update_post_meta( $post_id, 'pitchfork_vote', $_POST['pitchfork_vote'] );
	endif;
}
