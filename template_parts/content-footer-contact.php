<footer class="footer__contact">
    <div class="bg-left trans-slower delay-1"></div>
    <div class="bg-right trans-slow"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">           
				<?php
					/**
					 * Subfooter nav menu, allows top level items only
					 */
					if ( has_nav_menu( 'footer' ) ) { 
					    wp_nav_menu( 
						    array(
						        'theme_location'    => 'footer',
						        'depth'             => 1,
						        'container'         => false,
						        'container_class'   => false,
						        'menu_class'        => false
						    ) 
					    );
					}
				?>
			    <div class="menu-socials">
					<a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_skype"></i></a>
      				<a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_wordpress_square"></i></a>
       				<a href="<?php  home_url(); ?>" class="text-white"><i class="icon icon_mobile"></i></a>
      	  			<a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_instagram_square"></i></a>
    			</div>
			</div>
		</div><!--end for row-->
	</div><!--end of container-->
</footer>
