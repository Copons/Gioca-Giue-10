<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Gioca_Giue_10
 */
?>




<aside id="sidebar" class="sidebar widget-area" role="complementary">

	<div class="sidebar-top">
		<div id="sidebar-top-left">
			<a id="sidebar-close" href="#" class="icon-close"></a>
		</div>
		<a id="sidebar-home" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
		</a>
	</div>

	<div class="sidebar-content">

		<div class="widget">
			<div id="search-form">
				<?php get_search_form(); ?>
			</div>
		</div><div class="widget">
			<h2 class="home-link">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="icon-home2">
					<?php _e( 'Home', 'gg10' ); ?>
				</a>
			</h2>
		</div><div class="widget">
			<h2 class="fundamentals-link">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>category/fundamentals" rel="home" class="icon-fundamentals">
					<?php _e( 'The GG Fundamentals', 'gg10' ); ?>
				</a>
			</h2>
		</div>

		<?php
			if ( is_active_sidebar( 'sidebar' ) ) :
				dynamic_sidebar( 'sidebar' );
			endif;
		?>

		<div class="widget social-pages">
			<h2 class="widget-title">
				<?php _e( 'Socializzaci', 'gg10' ); ?>!
			</h2>
			<div>
				<a href="https://www.facebook.com/pages/Gioca-Giu%C3%A8/190873654325067" class="icon-facebook" target="_blank"></a>
				<a href="http://twitter.com/giocagiue" class="icon-twitter" target="_blank"></a>
				<a href="https://plus.google.com/100352557627343702187/" class="icon-google-plus2" target="_blank"></a>
				<a href="http://steamcommunity.com/groups/giocagiue" class="icon-steam" target="_blank"></a>
				<a href="http://www.giocagiue.it/feed/" class="icon-rss" target="_blank"></a>
				<a href="mailto:info@giocagiue.it" class="icon-email" target="_blank"></a>
			</div>
		</div>

		<div class="widget creative-commons">
			<h2 class="widget-title">
				<?php _e( 'Derubaci coscienzioso', 'gg10' ); ?>
			</h2>
			<div>
				<a href="http://creativecommons.org/licenses/by-nc-nd/3.0/" title="Licenza Creative Commons" target="_blank">
					<span class="icon-cc"></span>
					<span class="icon-cc-by"></span>
					<span class="icon-cc-nc-eu"></span>
					<span class="icon-cc-nd"></span>
				</a>
			</div>
		</div>

		<div class="widget">
			<h2 class="widget-title" onclick="window.location='<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/'; return false;">
				<?php _e( 'Area riservata', 'gg10' ); ?>
			</h2>
		</div>

		<footer class="widget">
			<h2 class="widget-title">
				<?php _e( 'Credits', 'gg10' ); ?>
			</h2>
			<div>
				<?php _e( 'Web Design', 'gg10' ); ?> <a href="http://www.copons.it/" target="_blank">Jacopo "Copons" Tomasone</a><br />
				<?php _e( 'Logo e sfondo', 'gg10' ); ?> <a href="http://giudittamatteucci.tumblr.com/" target="_blank">Giuditta Matteucci</a><br />
				<?php _e( 'Testing', 'gg10' ); ?> <a href="https://dl.dropboxusercontent.com/u/12429139/GiocaGiue/brodo.jpg" target="_blank">BRODO Swagga 41</a><br />
				<?php _e( 'Stile di vita', 'gg10' ); ?> <a href="http://www.youtube.com/watch?v=RnAMDg7IVWs" target="_blank">TSB</a><br />
				<?php _e( 'Banane', 'gg10' ); ?> <a href="http://www.youtube.com/watch?v=rKzh9Ct9QSE" target="_blank">BEoF</a>
			</div>
		</footer>

	</div>

</aside>