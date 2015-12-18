<?php 
	$directory = trailingslashit(get_template_directory_uri()); 
	$light = get_option('light_logo', $directory . 'style/img/logo-light.png');
	$dark = get_option('dark_logo', $directory . 'style/img/logo-dark.png');
	
?>

<nav class="top-bar">
	<div class="container">

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
						        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback'
					        )
					    );  
					} else {
						echo '<ul class="menu"><li><a href="'. admin_url('nav-menus.php') .'">Set up a navigation menu now</a></li></ul>';
					}
				?>
			</div>
			
		</div><!--end of row-->
		
		<div class="mobile-toggle">
			<i class="icon icon_menu"></i>
		</div>
		
	</div><!--end of container-->
</nav>