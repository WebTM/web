<?php 
	$directory = trailingslashit(get_template_directory_uri()); 
	
	$address = get_option('header_address', '300 Collins St Melbourne');
	$email = get_option('header_email', 'hello@pivot.net');
	
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
?>

<nav class="top-bar overlay-bar offscreen-menu">
	<div class="fullscreen-nav fade-fullscreen-nav container">
		<div class="row nav-menu clearfix">	
			<div class="pull-right">
				<div class="offscreen-toggle">			
					<i class="icon icon_menu text-white"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="offscreen-container">
		<?php
			if( $light )
				echo '<img class="logo" alt="Logo" src="'. $light .'">';

			if ( has_nav_menu( 'offscreen' ) ){
			    wp_nav_menu( 
			    	array(
				        'theme_location'    => 'offscreen',
				        'depth'             => 1,
				        'container'         => false,
				        'container_class'   => false,
				        'menu_class'        => 'menu'
			        )
			    );  
			} else {
				echo '<ul class="menu"><li><a href="'. admin_url('nav-menus.php') .'">Set up a navigation menu now</a></li></ul>';
			}
			
			if( function_exists('icl_get_languages') )
				ebor_language_selector_flags();
		?>
		
		<ul class="social-icons">
			<?php
				if( function_exists('edd_get_checkout_uri') && '1' == get_option('cart_icon','1') )
					ebor_edd_cart();
					
				if( function_exists('ebor_cart_icon') && '1' == get_option('cart_icon','1') )
					ebor_cart_icon();	

				for( $i = 1; $i < 4; $i++ ){
					if( get_option("header_social_url_$i") ) {
						echo '<li>
							      <a href="' . esc_url(get_option("header_social_url_$i"), $protocols) . '" target="_blank">
								      <i class="icon ' . get_option("header_social_icon_$i") . '"></i>
							      </a>
							  </li>';
					}
				} 
			?>
		</ul>
		
	</div>
</nav>