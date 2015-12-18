<?php 
	$directory = trailingslashit(get_template_directory_uri()); 
	
	$light = get_option('light_logo', $directory . 'style/img/logo-light.png');
	$dark = get_option('dark_logo', $directory . 'style/img/logo-dark.png');
	
	$address = get_option('header_address', '300 Collins St Melbourne');
	$email = get_option('header_email', 'hello@pivot.net');
	
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
?>

<nav class="top-bar overlay-bar">
	<div class="container">
	
		<div class="row utility-menu">
			<div class="col-sm-12">
				<div class="utility-inner clearfix">
				
					<?php
						if( $address )
							echo '<span class="alt-font"><i class="icon icon_pin"></i> '. $address .'</span> ';
							
						if( $email )
							echo '<span class="alt-font"><i class="icon icon_mail"></i> '. $email .'</span>';
					?>
				
					<div class="pull-right">
						<?php 
							if( '1' == get_option('header_login','1') )
								echo '<a href="'. wp_login_url() .'" class="btn btn-primary login-button btn-xs">'. __('Login', 'pivot') .'</a>';
						
							if( '1' == get_option('users_can_register') && '1' == get_option('header_signup','1') )
								echo '<a href="'. wp_registration_url() .'" class="btn btn-primary btn-filled btn-xs">'. __('Signup', 'pivot') .'</a>';
								
							if( function_exists('icl_get_languages') )
								ebor_language_selector_flags();
						?>
					</div>
					
				</div>
			</div>
		</div><!--end of row-->
	
	
		<div class="row nav-menu">
		
			<div class="col-sm-3 col-md-2 columns">
				<a href="<?php echo home_url(); ?>">
					<?php
						if( $light )
							echo '<img class="logo logo-light" alt="Logo" src="'. $light .'">';
						
						if( $dark )
							echo '<img class="logo logo-dark" alt="Logo" src="'. $dark .'">';
					?>
				</a>
			</div>
			
			<div class="col-sm-9 col-md-10 columns">
				<?php
					if ( has_nav_menu( 'primary' ) ){
					    wp_nav_menu( 
					    	array(
						        'theme_location'    => 'primary',
						        'depth'             => 3,
						        'container'         => false,
						        'container_class'   => false,
						        'menu_class'        => 'menu',
						        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						        'walker'            => new web_framework_medium_rare_bootstrap_navwalker()
					        )
					    );  
					} else {
						echo '<ul class="menu"><li><a href="'. admin_url('nav-menus.php') .'">Set up a navigation menu now</a></li></ul>';
					}
				?>
	
				<ul class="social-icons text-right">
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

		</div><!--end of row-->
		
		<div class="mobile-toggle">
			<i class="icon icon_menu"></i>
		</div>
		
	</div><!--end of container-->
</nav>