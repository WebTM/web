<?php
/**
 *
 * @package webtm
 */

get_header(); 

?>

<?php get_template_part('content/blog', get_option('blog_layout','grid-sidebar')); ?>


<?php 

get_footer(); 

?>
