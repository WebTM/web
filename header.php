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
	<?php wp_head(); ?>
</head>

<body>
<?php 
	get_template_part('menu/nav','start'); 
	get_template_part('menu/menu', web_get_header_layout()); 
	get_template_part('menu/nav','end');
		
?>
<div id="page">
	<div id="content">