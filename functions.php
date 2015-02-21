<?php
/**
 * Gioca Giue 10 functions and definitions
 *
 * Set up the theme and provides some helper functions
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * @package Gioca_Giue_10
 */




/**
 * Gioca Giue 10 setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 */
function gg10_setup() {

	/*
	 * Make Gioca Giue 10 available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'gg10', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1000, 500, true );
	add_image_size( 'gg-full-width', 1920, 1080, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'css/editor.css', gg10_fonts_url() ) );

}
add_action( 'after_setup_theme', 'gg10_setup' );




/**
 * Register widget area.
 */
function gg10_widgets_init() {
	
	require ( 'inc/widgets.php' );
	
	register_widget( 'GG10_Popular_Posts' );
	register_widget( 'GG10_Recent_Comments' );
	register_widget( 'GG10_Authors_List' );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'gg10' ),
		'id'            => 'sidebar',
		'description'   => __( 'Aggiungi widget alla sidebar.', 'gg10' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="widget-body">',
	) );

	register_sidebar( array(
		'name'          => __( 'Ads', 'gg10' ),
		'id'            => 'loop-aside',
		'description'   => __( 'Aggiungi un banner nella homepage.', 'gg10' ),
		'before_widget' => '<aside id="%1$s" class="loop-aside %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="widget-body">',
	) );

}
add_action( 'widgets_init', 'gg10_widgets_init' );




/**
 * Register Google fonts for Gioca Giue 10.
 *
 * @return string Google fonts URL for the theme.
 */
function gg10_fonts_url() {

	$fonts_url = '';
	$fonts     = array(
		'Open+Sans:400italic,700italic,400,700',
		'Press+Start+2P',
		'Raleway:300,400,700'
	);

	$fonts_url = add_query_arg( array(
		'family' => urlencode( implode( '|', $fonts ) )
	), '//fonts.googleapis.com/css' );

	return $fonts_url;
}




/**
 * Enqueue scripts and styles.
 */
function gg10_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'gg10-fonts', gg10_fonts_url(), array(), null );

	// Load the main stylesheet.
	wp_enqueue_style( 'gg10-style', get_template_directory_uri() . '/css/style.css', array(), '2.1.0' );

	// Load the comment editor stylesheet.
	wp_enqueue_style( 'gg10-comment-style', get_template_directory_uri() . '/css/comment-editor.css', array( 'gg10-style' ), '1.1.1' );

	// Load the css helper script
	wp_enqueue_script( 'gg10-css-browser-selector', get_template_directory_uri() . '/js/css_browser_selector.min.js', array(), '0.6.3', false );

	// Load the swipe sidebar script
	wp_enqueue_script( 'gg10-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array(), '1.2.1', true );

	// Load the modal box script
	wp_enqueue_script( 'gg10-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
	
	// Load the functions script
	wp_enqueue_script( 'gg10-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.4.0', true );

}
add_action( 'wp_enqueue_scripts', 'gg10_scripts' );




/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function gg10_title( $title, $sep ) {

	if ( is_feed() ) :
		return $title;
	endif;

	return $title . ' ' . $sep . ' ' . get_bloginfo( 'name' );

}
add_filter( 'wp_title', 'gg10_title', 10, 2 );




/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function gg10_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) :
		$classes[] = 'has-post-thumbnail';
	endif;

	return $classes;
}
add_filter( 'post_class', 'gg10_post_classes' );




/**
 * If enabled, replace the excerpt with the Yoast Wordpress SEO plugin meta description.
 *
 * @global WP_Post $post Current post.
 *
 * @param string $excerpt Current post excerpt.
 * @return string The Yoast Wordpress SEO meta description.
 */
function gg10_excerpt( $excerpt ) {

	global $post;

	if ( '' != get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true ) ) :
		return get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
	else :
		return $excerpt;
	endif;

}
add_filter( 'get_the_excerpt', 'gg10_excerpt' );




/**
 * Improved HTML5 Caption
 *
 * Removes inline styling from wp-caption and changes to HTML5 figure/figcaption.
 *
 * CURRENTLY DISABLED FOR TESTING PURPOSES
 * 
 * Props to https://github.com/blineberry/Improved-HTML5-WordPress-Captions
 */

function orangegnome_img_caption_shortcode_filter( $val, $attr, $content = null ) {

	extract( shortcode_atts( array(
		'id'		=> '',
		'align'		=> '',
		'width'		=> '',
		'caption'	=> ''
	), $attr ) );

	if ( 1 > (int) $width || empty( $caption ) ) :
		return $val;
	endif;

	$figure = '<figure';
	$figure .= ' id="' . $id . '"';
	$figure .= ' class="wp-caption ' . esc_attr( $align ) . '"';
	$figure .= ' style="width: ' . $width . 'px;"';
	$figure .= '>';
	$figure .= do_shortcode( $content );
	$figure .= '<figcaption class="wp-caption-text">';
	$figure .= $caption;
	$figure .= '</figcaption>';
	$figure .= '</figure>';

	return $figure;

}
//add_filter( 'img_caption_shortcode', 'orangegnome_img_caption_shortcode_filter', 10, 3 );




/**
 * Enable threaded comments.
 */
function gg10_enable_threaded_comments() {

	if ( is_singular() && comments_open() && 1 == get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

}
add_action( 'get_header', 'gg10_enable_threaded_comments' );




/**
 * Customize users contact methods
 *
 * @param array $contact_methods Contact information fields.
 * @return array Contact information fields.
 */
function gg10_contactmethods( $contact_methods ) {

	// Add
	$contact_methods['facebook'] = 'Facebook (URL)';
	$contact_methods['twitter'] = 'Twitter (Username)';
	$contact_methods['google'] = 'Google+ (URL)';
	$contact_methods['steam'] = 'Steam (Username)';
	$contact_methods['xbl'] = 'Xbox Live (Username)';
	$contact_methods['psn'] = 'PlayStation Network (Username)';
	
	// Remove
	unset( $contact_methods['yim'] );
	unset( $contact_methods['aim'] );
	unset( $contact_methods['jabber'] );
	
	return $contact_methods;

}
add_filter( 'user_contactmethods' , 'gg10_contactmethods', 10, 1 );




/**
 * Customize login page
 */
function gg10_login() {

	wp_enqueue_style( 'gg10-login', get_template_directory_uri() . '/css/login.css', array(), '1.0.0' );

}
add_action( 'login_enqueue_scripts', 'gg10_login' );




/**
 * Avatar Customization 1
 *
 * Get an user avatar image tag.
 *
 * @param mixed $id_or_email Author’s User ID (an integer or string), an E-mail Address (a string) or the comment object from the comment loop.
 * @param int $size Size of the avatar to return.
 * @return string An img element.
 */
function gg10_get_avatar( $id_or_email, $size ) {

	if ( function_exists( 'get_wp_user_avatar' ) ) :
		return get_wp_user_avatar( $id_or_email, $size );
	else :
		return get_avatar( $id_or_email, $size );
	endif;

}




/**
 * Avatar Customization 2
 * 
 * Get an user avatar image url.
 *
 * @param mixed $id_or_email Author’s User ID (an integer or string), an E-mail Address (a string) or the comment object from the comment loop.
 * @param int $size Size of the avatar to return.
 * @return string An image url.
 */
function gg10_get_avatar_src( $id_or_email, $size ) {

	if ( function_exists( 'get_wp_user_avatar_src' ) ) :
		return get_wp_user_avatar_src( $id_or_email, $size );
	else :
		$avatar = get_avatar( $id_or_email, $size );
		preg_match("/src='(.*?)'/i", $avatar, $matches);
		return $matches[1];
	endif;

}




/**
 * TinyMCE Customization 1
 *
 * Add the styleselect button to the TinyMCE editor.
 *
 * @param array $buttons TinyMCE buttons array.
 * @return array TinyMCE buttons array
 */
function gg10_mce_buttons_2( $buttons ) {

	array_unshift( $buttons, 'styleselect' );
	return $buttons;

}
add_filter( 'mce_buttons_2', 'gg10_mce_buttons_2' );




/**
 * TinyMCE Customization 2
 *
 * Add the custom caption settings to the TinyMCE editor.
 *
 * @param array $settings TinyMCE settings array.
 * @return array TinyMCE settings array
 */
function gg10_tiny_mce_before_init( $settings ) {

	$style_formats = array(
		array(
			'title'		=> 'Custom Caption',
			'inline'	=> 'span',
			'classes'	=> 'wp-caption-text'
		)
	);
	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;

}
add_filter( 'tiny_mce_before_init', 'gg10_tiny_mce_before_init' );




/**
 * Add TinyMCE to comments.
 */
function gg10_mce_comments() {

	ob_start();
	wp_editor( '', 'comment', array(
			'media_buttons'	=> false,
			'textarea_rows'	=> 7,
			'tinymce'		=> array(
				'content_css'			=> get_stylesheet_directory_uri() . '/css/comment-editor.css',
				'toolbar1'				=> 'bold, italic, blockquote, link, unlink, image',
				'toolbar2'				=> false,
				'paste_remove_styles'	=> true,
				'paste_remove_spans'	=> true
			),
			'quicktags'		=> false
		)
	);
	return ob_get_clean();

}

function gg10_comment_form_defaults( $defaults ) {
	$defaults['comment_field'] = gg10_mce_comments();
	return $defaults;
}
add_filter( 'comment_form_defaults', 'gg10_comment_form_defaults' );




/**
 * Extend KSES to allow more tags and attributes.
 */
$allowedtags['p'] = array( 'class' => true );
$allowedtags['img'] = array( 'src' => true );




/**
 * Include Gioca Giue 10 meta boxes
 */
require_once( 'inc/meta-boxes.php' );




/**
 * Manually exclude a category from being used as a featured content
 */
$excluded_categories = array(
	2632	// ruined-orgasm
);
