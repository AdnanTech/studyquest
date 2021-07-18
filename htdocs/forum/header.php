<!DOCTYPE html>

<html dir="ltr" lang="en-UK">
<head>
	<!-- Meta
	============================================= -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Document Title
	============================================= -->
 	<title>Study Quest Forum</title>


	<!-- Stylesheets
	============================================= -->
	<link rel="stylesheet" href="../style/normalize.css">
	<!-- <link rel="stylesheet" href="../style/main.css"> -->
	<link rel="stylesheet" href="../style/upgrade.css">
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<!-- Favicon
	============================================= -->
	<!-- <link rel="icon" href="img/icon.png"> -->

</head>

<body>
<h1>Study Quest Forum</h1>
	<div id="wrapper">
	<div id="menu">
		<a class="item" href="index.php">Home</a> -
		
		
	<?php
		if(isset($_SESSION['signed_in']) AND $_SESSION['signed_in'] == True)
		{
			echo '<a class="item" href="create_topic.php">Create a topic</a> -';
		    echo '<a class="item" href="create_category.php">Create a category</a> -';
			echo 'Hello <b>' . $_SESSION['user_name'] . '</b>. Not you? - <a class="item" href="signout.php">Sign out</a>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign In</a> - <a class="item" href="signup.php">Sign Up</a>';
		}
	?>
	</div>
		<div id="content">