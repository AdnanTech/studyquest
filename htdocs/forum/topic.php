<?php
include '../navbar.php';
include 'database.php';
include 'header.php';

$sql = "SELECT topic_id, topic_subject FROM topics WHERE topics.topic_id = " . $_GET['id'];
			
$result = mysqli_query($connect_database, $sql);

if(!$result)
{
	echo '<br><font style="font-size: 14px;">The topic could not be displayed, please try again later.</font><br><br>';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo '<br><font style="font-size: 14px;">This topic doesn&prime;t exist.</font><br><br>';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			// display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT posts.post_topic, posts.post_content, posts.post_date, posts.post_by, users.user_id, users.user_name
					FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE posts.post_topic = " . $_GET['id'];
						
			$posts_result = mysqli_query($connect_database, $posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysqli_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post"><font style="font-size: 14px;">' . $posts_row['user_name'] . '<br>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</font></td>
							<td class="post-content"><pre style="font-size: 14px;">' . stripslashes(htmlentities($posts_row['post_content'])) . '</pre></td>
						  </tr>';
				}
			}
			
			// user is not signed in
			if(!isset($_SESSION['signed_in']))
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				// show reply box
				echo '<tr><td colspan="2"><font style="font-size: 18px;">Reply:</font><br>';
				echo '<form method="post" action="reply.php?id=' . $row['topic_id'] . '">';
				echo '<textarea style="resize:none;" name="reply-content" rows="10" cols="70" wrap="pyhsical"></textarea><br><br>';
				echo '<input type="submit" value="Submit reply"></input>';
				echo '</form></td></tr>';
			}
			
			// finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
mysqli_close($connect_database);
?>