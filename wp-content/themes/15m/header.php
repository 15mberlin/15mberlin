<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	
	<?php wp_head(); ?>
	
	<link href="<?php bloginfo ('stylesheet_url'); ?>" rel="stylesheet" media="screen">
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/main.js" type="text/javascript"></script>
	
</head>
<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>