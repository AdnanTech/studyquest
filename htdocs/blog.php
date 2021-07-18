<?php require('includes/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
		<link rel="stylesheet" href="style/upgrade.css">
</head>
<body>
	
	<?php
		include 'navbar.php';
	?>

	<div id="wrapper">
		<h1>Developer Blog</h1>
		<hr />

		<?php
			try 
			{
				$sqlquery = $db->query('SELECT postID, postTitle, postDescription, postDate FROM blog_posts ORDER BY postID DESC');
				while($row = $sqlquery->fetch())
				{
					echo '<div>';
						echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
						echo '<p>'.$row['postDescription'].'</p>';				
						echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';				
					echo '</div>';
				}
			} 
			catch(PDOException $e) 
			{
			    echo $e->getMessage();
			}
		?>
	</div>

</body>
</html>