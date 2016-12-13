<?php
	get_header();

	$term = get_queried_object();
	$title = $term->name;

?>



	<section class="projects-gallery dark-wrapper">


			<div class="container-fluid">
				<div class="row">


				<?php


						get_template_part('template_parts/content', 'fonts');




				?>

			</div>
		</div>

	</section>

<?php get_footer();
