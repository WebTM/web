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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700,800&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php get_template_part('template_parts/content', web_get_header_layout()); ?>
	<div class="main-container">