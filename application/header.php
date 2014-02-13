<?php
include 'config.php';

if(!isset($page)) $page = 'Marvel API Interface';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Marvel API Interface</title>

	<link href="css/style.css" media="all" rel="stylesheet" type="text/css">

	<script type="text/javascript">
		window.onload = function() {
			var m = document.getElementById(document.getElementById('page-title').innerHTML);
			m.className = m.className + ' current';
		};
	</script>
</head>
<body>
	<ul class="header-menu">
		<li id="page-title"><?php echo $page; ?></li>
		<li class="item" id="home"><a href="index.php">Home</a></li>
		<li class="item" id="characters"><a href="characters.php">Characters</a></li>
	</ul><div class="content">