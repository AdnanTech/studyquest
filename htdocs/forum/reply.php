<?php
include '../navbar.php';
include 'database.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	// don't call file directly
	echo '<br><font style="font-size: 14px;">This file cannot be called directly.</font><br><br>';
}
else
{
	// check if singed in
	if(!isset($_SESSION['signed_in']))
	{
		echo '<br><font style="font-size: 14px;">You must be signed in to post a reply.</font><br><br>';
	}
	else
	{
		// post reply to database
		$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by) 
				VALUES ('" . addslashes($_POST['reply-content']) . "', NOW(), " . $_GET['id'] . ", " . $_SESSION['user_id'] . ")";
						
		$result = mysqli_query($connect_database, $sql);
						
		if(!$result)
		{
			echo '<br><font style="font-size: 14px;">Your reply has not been saved, please try again later.</font><br><br>';
		}
		else
		{
			echo '<br><font style="font-size: 14px;">Your reply has been saved, check out <a href="topic.php?id=' . $_GET['id'] . '">the topic</a>.</font><br><br>';
		}
	}
}

include 'footer.php';
mysqli_close($connect_database);
?>