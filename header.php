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
<div id="page">
	<div id="content">
	<?php get_template_part('header/content-header', web_get_header_layout()); ?>
	
	<header class="page-header">

	</header>