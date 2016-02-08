<footer class="bg-primary short-2">
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
			</div>
		</div><!--end for row-->
	</div><!--end of container-->
	
	<?php if( get_option('cta_footer_url', home_url()) ) : ?>
		<div class="contact-action">
			<div class="align-vertical">
				<a href="<?php echo esc_url( get_option('cta_footer_url', home_url()) ); ?>" class="text-white">
					<span class="text-white"><?php echo get_option('cta_footer_text', 'Get in touch with us'); ?> <i class="icon arrow_right"></i></span>
				</a>
			</div>
		</div>
	<?php endif; ?>
	
</footer>