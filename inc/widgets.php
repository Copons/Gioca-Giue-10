<?php
/**
 * Custom widgets for Gioca Giue 10
 *
 * @package Gioca_Giue_10
 */


load_theme_textdomain( 'gg10', get_template_directory() . '/languages' );


class GG10_Popular_Posts extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'widget_gg10_popular_posts',
			__( 'GG10 Popular Posts', 'gg10' ),
			array(
				'classname'		=> 'widget_gg10_popular_posts',
				'description'	=> __( 'Articoli Popolari', 'gg10' ),
			)
		);

	}


	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title'];
		endif;

		echo '<ol>';

		$popular = new WP_Query( array(
			'orderby'				=> 'comment_count',
			'posts_per_page'		=> $instance['number'],
			'ignore_sticky_posts'	=> 1
		) );
		while ( $popular->have_posts() ) : $popular->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
					<span>(<?php comments_number( '0', '1', '%' ); ?>)</span>
				</a>
			</li>
		<?php endwhile;

		echo '</ol>';

		echo $args['after_widget'];

		wp_reset_postdata();

	}


	function update( $new_instance, $instance ) {

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['number'] = empty( $new_instance['number'] ) ? 5 : absint( $new_instance['number'] );

		return $instance;

	}


	function form( $instance ) {

		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );

		$number = empty( $instance['number'] ) ? 5 : absint( $instance['number'] );


		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Titolo', 'gg10' ); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Numero di post da mostrare', 'gg10' ); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

		<?php

	}

}




class GG10_Recent_Comments extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'widget_gg10_recent_comments',
			__( 'GG10 Recent Comments', 'gg10' ),
			array(
				'classname'		=> 'widget_gg10_recent_comments',
				'description'	=> __( 'Commenti Recenti', 'gg10' ),
			)
		);

	}


	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title'];
		endif;

		echo '<ul>';

		$comments = get_comments( array(
			'number'	=> $instance['number'],
			'status'	=> 'approve',
			'type'		=> 'comment'
		) );

		foreach ( $comments as $comment ) : ?>

			<li>
				<a href="<?php echo get_comment_link( $comment->comment_ID ); ?>" title="<?php _e( 'Comment a', 'gg10' ); ?>: <?php echo get_the_title( $comment->comment_post_ID ); ?>">
					<div>
						<span class="comment-author">
							<?php echo $comment->comment_author; ?>
						</span>
						a
						<span class="comment-post">
							<?php echo get_the_title( $comment->comment_post_ID ); ?>
						</span>
					</div>
					<?php
						$stripped_comment = strip_tags_preg ( $comment->comment_content, 'blockquote' );
						$stripped_comment = strip_tags( $stripped_comment );
						if ( strlen( $stripped_comment ) > $instance['length'] ) :
							$stripped_comment = mb_substr( $stripped_comment, 0, $instance['length'] );
							$stripped_comment = mb_substr( $stripped_comment, 0, strrpos( $stripped_comment, ' ' ) );
							echo $stripped_comment . '&hellip;';
						else :
							echo $stripped_comment;
						endif;
					?>
				</a>
			</li>

		<?php endforeach;

		echo '</ul>';

		echo $args['after_widget'];

	}


	function update( $new_instance, $instance ) {

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['number'] = empty( $new_instance['number'] ) ? 5 : absint( $new_instance['number'] );

		$instance['length'] = empty( $new_instance['length'] ) ? 100 : absint( $new_instance['length'] );

		return $instance;

	}


	function form( $instance ) {

		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );

		$number = empty( $instance['number'] ) ? 5 : absint( $instance['number'] );

		$length = empty( $instance['length'] ) ? 100 : absint( $instance['length'] );

		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo 'Titolo:'; ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Numero di commenti da mostrare', 'gg10' ); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Lunghezza massima del commento', 'gg10' ); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" value="<?php echo esc_attr( $length ); ?>" size="3"></p>

		<?php

	}

}




class GG10_Authors_List extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'widget_gg10_authors_list',
			__( 'GG10 Authors List', 'gg10'),
			array(
				'classname'		=> 'widget_gg10_authors_list',
				'description'	=> __( 'Lista degli autori', 'gg10' ),
			)
		);

	}


	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title'];
		endif;

		echo '<ul>';

		wp_list_authors();

		echo '</ul>';

		echo $args['after_widget'];

	}


	function update( $new_instance, $instance ) {

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;

	}


	function form( $instance ) {

		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );

		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Titolo', 'gg10' ); ?>:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

		<?php

	}

}






/**
 * Quick and dirty helpers functions
 */

function strip_tags_content( $text, $tags = '', $invert = false ) {
	preg_match_all( '/<(.+?)[\s]*\/?[\s]*>/si', trim( $tags ), $tags );
	$tags = array_unique( $tags[1] );
	if ( is_array( $tags ) && count( $tags ) > 0 ) :
		if ( $invert == false ) :
			return preg_replace( '@<(?!(?:' . implode( '|', $tags ) . ')\b)(\w+)\b.*?>.*?</\1>@si', '' , $text );
		else :
			return preg_replace( '@<(' . implode( '|', $tags ) . ')\b.*?>.*?</\1>@si', '', $text );
		endif;
	elseif ( $invert == false ) :
		return preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $text );
	else :
		return $text;
	endif;
}

function strip_tags_dom ( $text, $tag ) {
	$dom = new DOMDocument();
	$dom->loadHTML( mb_convert_encoding( $text, 'HTML-ENTITIES', 'UTF-8' ) );
	$dom->preserveWhiteSpace = false;

	$elements = $dom->getElementsByTagName( $tag );
	while ( $elem = $elements->item( 0 ) ) :
		$elem->parentNode->removeChild( $elem );
	endwhile;
	return $dom->saveHTML();
}

function strip_tags_preg ( $text, $tags ) {
	return preg_replace( '#<(' .  $tags . ')(?:[^>]+)?>.*?</\1>#s', '', $text );
}
