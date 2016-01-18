<?php
/**
 * @package webtm
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php bloginfo( 'name' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<?php wp_head(); ?>
</head>

<body>
<?php 
	get_template_part('menu/menu', web_get_header_layout()); 		
?>
<div class="main-container">