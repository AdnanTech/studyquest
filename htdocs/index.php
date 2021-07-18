<?php require('includes/config.php'); ?>
<!DOCTYPE html>

<html dir="ltr" lang="en-UK">
<head>
    <!-- Meta
    ============================================= -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets
	  ============================================= -->
	  <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
	  <link rel="stylesheet" href="style/upgrade.css">
  
    <!-- Document Title
    ============================================= -->
    <title>Study Quest</title>

    <!-- Favicon
    ============================================= -->
    <link rel="icon" href="img/icon.png">
</head>

<body>

  <!-- Navbar
  ============================================= -->	
	<?php
		include 'navbar.php';
	?>

	<div id="wrapper">
		<!-- Header
		============================================= -->

    <header>
      <h1 id="title">Study Quest</h1><br>
    </header>

    <div style="width: 60%; float:left">
      <h3>A project for School Children and Education entities that gamifies the process of 
          learning. Built for the Level Up Society Hackathon.
      </h3>
      <h2>
        Click <a href="studyquest.php">here</a> to play now!
      </h2>  
    </div>

    <div style="width: 40%; float:right">
    <img  src="img/1.png">
    </div>


   

		<!-- Footer
		============================================= -->
    <?php
		  include 'footer.php';
	  ?>

	</div>
</body>
</html>