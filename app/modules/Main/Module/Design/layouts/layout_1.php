<!DOCTYPE html>
<html>
<head>
	<title>LAYOUT 1</title>
</head>
<body>
	<header></header> 
	<?php dd($content, $include);//echo get_includes('mini_header', 'App_Main_Module'); ?>
	<?php //echo get_includes('header/main_header'); ?>
	<?php echo $include['App_Main_Module::header/mini_header']; ?>
	<?php echo $content['content']; ?> 
	<footer></footer>
</body>
</html>