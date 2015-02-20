jQuery( document ).ready( function( $ ) {



	// On window resize scale the featuring image accordingly (see bottom of this file)

	if ( $( 'article' ).hasClass( 'single has-post-thumbnail' ) ) {
		featured_image_fix();
		var resize_timeout;
		$( window ).resize( function() {
			clearTimeout( resize_timeout );
			resize_timeout = setTimeout( featured_image_fix, 300 );
		} );
	}




	// While scrolling, make the fixed nav buttons semi-transparent

	$( window ).scroll( function() {
		if ( $( window ).scrollTop() > 10 ) {
			$( '#fixed-nav' ).addClass( 'transparent' );
		}
		else {
			$( '#fixed-nav' ).removeClass( 'transparent' );
		}
	} );




	// Sidr sidebar toggle

	$( '#sidebar-toggle, #sidebar-close' ).sidr({
		name:		'sidebar',
		displace:	false
	});




	// Sidebar menu items slideToggle

	$( '#sidebar .widget-title' ).on( 'click', function() {
		$( this ).next( '.widget-body' ).slideToggle();
		
	} );




	/* TinyMCE for replies */

	$( '#comments .quote' ).on( 'click', function( e ) {
		e.preventDefault();
		var comment_id = $( this ).attr( 'data-comment' ),
			comment_author = $( this ).attr( 'data-author' ),
			$comment_quotable,
			quote;

		$comment_quotable = $( '#'+comment_id+' .quotable' ).clone();
		$comment_quotable.find( 'blockquote' ).remove();

		quote = '<blockquote><p class="quote-by"><strong>' + comment_author + '</strong> ha querelato: <a href="#' + comment_id + '">&nbsp;</a></p>' + $comment_quotable.html() + '</blockquote><p></p>';

		tinymce.EditorManager.execCommand( 'mceInsertContent', true, quote );

		location.hash = 'respond';
	} );




	// Smooth scrolling toward anchors

	$( 'a[href^="#"]' ).on( 'click', function( e ) {
		e.preventDefault();
		var target, $target;
		target = this.hash;
		if ( target === '' ) { return false; }
		$target = $( target );
		$( 'html, body' ).stop().animate( {
			'scrollTop': $target.offset().top
		}, 500, function() {
			window.location.hash = target;
		} );
	} );




	// Arrow fadeOut when clicked

	$( '#gotostart a' ).on( 'click', function( e ) {
		$( '#gotostart' ).fadeOut();
	} );




	// Social sharing popups

	$('.social.facebook, .social.twitter, .social.googleplus').click(function(e){
		e.preventDefault();
		var target, permalink, title;
		target = $(this).attr('href');
		permalink = $(this).parent('.post-meta').data('permalink');
		title = $(this).parent('.post-meta').data('title');
		if ($(this).hasClass('facebook')) {
			_gaq.push(['_trackSocial', 'facebook', 'send', title]);
		}
		else if ($(this).hasClass('twitter')) {
			_gaq.push(['_trackSocial', 'twitter', 'tweet', title]);
		}
		window.open(
			target,
			'Spamma!',
			'width=500,height=300'
		);
	});




	// MagnificPopup modal box

	var $images = $("a[rel='lightbox'], a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png'], a[href$='.JPG'], a[href$='.JPEG'], a[href$='.GIF'], a[href$='.PNG']");
	$images.each( function() {
		if ( $( this ).next().hasClass( 'wp-caption-text' ) ) {
			$( this ).attr( 'title', '<span>' + $( this ).next().html() + '</span>' );
		}
	} );
	$images.magnificPopup( {
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile mfp-with-zoom',
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}

	} );




	// Featured image fix (see top of this file)

	function featured_image_fix () {

		if ( $( 'html' ).hasClass( 'mobile' ) ) return;

		var $image_container = $( 'article.single.has-post-thumbnail .featured-image' ),
			$post_header = $( 'article.single.has-post-thumbnail .featured-image header' );

		//console.log( $post_header.height() + ' ' + $(window).height() );

		if ( $post_header.height() > $( window ).height() ) {
			$image_container.css( {
				'height' : 'auto',
				'padding-top' : '80px'
			} );
			$post_header.css( {
				'position' : 'relative'
			} );
		}
		else {
			$image_container.css( {
				'height' : '100vh',
				'padding-top' : '0'
			} );
			$post_header.css( {
				'position' : 'absolute'
			} );
		}

	}
	
} );
