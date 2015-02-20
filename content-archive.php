<?php
/**
 * The Gioca Giue 10 template for displaying archive pages headers
 *
 * @package Gioca_Giue_10
 */




$archive = new stdClass();

$archive->description = term_description();


if ( is_category('fundamentals') ) :

	$archive->type		= 'fundamentals';
	$archive->title		= single_cat_title( '', false );

elseif ( is_category() ) :

	$archive->type		= 'category';
	$archive->title		= single_cat_title( '', false );

elseif ( is_tag() ) :

	$archive->type		= 'tag';
	$archive->title		= single_tag_title( '', false );

elseif ( is_author() ) :

	$archive->type		= 'author';
	if ( get_query_var( 'author_name' ) ) :
		$author			= get_user_by( 'slug' , get_query_var( 'author_name' ) );
	else :
		$author			= get_userdata( get_query_var( 'author' ) );
	endif;
	$archive->title		= $author->display_name;
	$archive->description		= str_replace( "\n", '<br />', $author->description );

elseif ( is_search() ) :

	$archive->type		= 'search';
	$archive->title		= __( 'Hai cercato', 'gg10' ) . ' "' . get_search_query() . '"';
	$results = $wp_query->found_posts;
	if ( 1 == $results ) :
		$result_description	= ' ' . __( 'risultato', 'gg10' );
	else :
		$result_description	= ' ' . __( 'risultati', 'gg10' );
	endif;
	$archive->description		= $results . $result_description;

elseif ( is_404() ) :

	$archive->type			= '404';
	$archive->title			= __( 'AMMERDA!!', 'gg10' );
	$archive->description	= __( 'La pagina che stai cercando non esiste!', 'gg10' ) . '<br />' . __( 'Fa&apos; il serio e non ci provare mai pi&ugrave;.', 'gg10' );

elseif ( is_day() ) :
	$archive->type			= 'day';
	$archive->title			= __( 'Archivio del', 'gg10' ) . ' ' . ucwords( get_the_date() );
	$archive->description	= '';

elseif ( is_month() ) :
	$archive->type			= 'month';
	$archive->title			= __( 'Archivio di', 'gg10' ) . ' ' . ucwords( get_the_date( 'F Y' ) );
	$archive->description	= '';

elseif ( is_year() ) :
	$archive->type			= 'year';
	$archive->title			= __( 'Archivio di', 'gg10' ) . ' ' . ucwords( get_the_date( 'Y' ) );
	$archive->description	= '';

endif;

?>

<header id="archive-header" class="archive-header <?php echo $archive->type; ?>" role="banner">

	<?php if ( $archive->type == 'author' ) : ?>

		<h2>
			<?php _e( 'Tutti i capolavori assoluti di giornalismo videoludico del Blasonato Autore', 'gg10' ); ?>
		</h2>

	<?php endif; ?>

	<h1>
		<?php echo $archive->title; ?>
	</h1>

	<div>
		<?php echo $archive->description; ?>
	</div>

</header>
