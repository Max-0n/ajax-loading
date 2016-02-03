<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" class="intro">
	<head>
		<title>Max0n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="content-language" content="ru-RU" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="author" content="Максим Рожков">
		<meta name="contact" content="admin@max0n.com" />
		<meta name="copyright" content="Copyright © 2015 Рожков Максим. All Rights Reserved." />
		<link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.png" type="image/png" />
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.png" type="image/png" />
		<link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/favicon.svg" color="#1DA1F2">
		
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/intro.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/animation.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/styles/xcode.css">
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-2.1.4.min.js"></script>
		<script async type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/highlight.pack.js"></script>
		<!-- //////////////////////// -->
		<?php wp_head();  ?>
		<!-- //////////////////////// -->

<?php
	//Если не Mac, то подключить стили
	if( !strpos( getenv("HTTP_USER_AGENT") , "Mac") ) 
	echo '<style>::-webkit-scrollbar{background-color: none; width: 3px; overflow: visible; }::-webkit-scrollbar:horizontal{background-color: none; height: 3px;}::-webkit-scrollbar-thumb{background-color: rgba(0,0,0,0.15);border-radius:10px;}::-webkit-scrollbar-thumb:hover{background-color: rgba(0,0,0,0.3);}</style>';
?>
		
		
	</head>
	<body>
		<?php if( !strpos($_SERVER['HTTP_REFERER'], 'max0n.com') ): ?>
		<div style="display: table; position: fixed; height: 100%; width: 100%; margin: 0; z-index: 10;" id="fading">
			<div style="display: table-cell; vertical-align: middle;">
				<svg style="margin: auto; display: block; width: 100%; height: 100%; background: <?php //#1da1f2; ?>linear-gradient(to top, #056dad, #6bc6ff);" viewBox="-170 -40 680 160">
					<g fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" id="intro">
						<line class="path1_0" x1="12.3" y1="56" x2="29.9" y2="23.6"/>
						<circle class="path1_1" cx="42.4" cy="37.8" r="0.1" />
						<line class="path1_2" x1="72.6" y1="56" x2="54.9" y2="23.6"/>
						
						<path class="path2" d="M114.3,56.2c-9,0-16.2-7.3-16.2-16.2s7.3-16.2,16.2-16.2S130.5,31,130.5,40v16.2"/>
						<g class="r2">
							<line class="path3" x1="154.8" y1="23.6" x2="162.2" y2="31.1"/>
							<line class="path3" x1="154.8" y1="56.2" x2="162.2" y2="48.8"/>
							<line class="path3" x1="187.4" y1="23.6" x2="179.9" y2="31.1"/>
							<line class="path3" x1="187.4" y1="56.2" x2="179.9" y2="48.8"/>
						</g>
						<path class="path4" d="M231.7,68.4c3,1,6.3,1.6,9.7,1.6c16.6,0,30-13.4,30-30s-13.4-30-30-30s-30,13.4-30,30c0,2.5,0.3,4.9,0.9,7.2"/>
						
						<path class="path5" d="M295.5,23.8c6.2,0,7.2,0,16.1,0s16.1,7.2,16.1,16.1V56"/>
						<path class="path6" d="M295.5,56c0-2.1,0-8.2,0-12"/>
					</g>
				</svg>
			</div>
		</div>
		<?php endif; ?>