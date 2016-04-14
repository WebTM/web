<footer class="short-2">
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
			</div>
            
            
    <?php if( get_option('cta_footer_url', home_url()) ) : ?>
		<div class="contact-action">
			<div class="align-vertical">
				<a href="<?php echo esc_url( get_option('cta_footer_url', home_url()) ); ?>" class="text-white">
					<span class="text-white"><?php echo get_option('cta_footer_text', 'Get in touch with us'); ?> <i class="icon arrow_right"></i></span>
				</a>
			</div>
		</div>
	<?php endif; ?>
    
    
	<div class="site-info">
			&copy; 
            <?php echo date("Y") ?>
            <?php bloginfo( 'name' ); ?>
    </div>
    <div class="menu-socials">
		<a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_skype"></i></a>
        <a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_wordpress_square"></i></a>
        <a href="<?php  home_url(); ?>" class="text-white"><i class="icon icon_mobile"></i></a>
        <a href="<?php  home_url(); ?>" class="text-white"><i class="icon social_instagram_square"></i></a>
    </div>
    
		</div><!--end for row-->
	</div><!--end of container-->
</footer>