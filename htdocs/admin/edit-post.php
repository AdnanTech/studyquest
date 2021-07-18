<?php // include config
require_once('../includes/config.php');

include '../navbar.php';
// if not logged in redirect to login page
if(!$user->is_logged_in()) { header('Location: login.php'); }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-UK">
<head>
	<meta charset="utf-8">
	<title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <link rel="stylesheet" href="../style/upgrade.css">
	<script src="https://cdn.tiny.cloud/1/2cuac26rk3oiar1txd04rk5nm2mdrixjrj1sfpnlm6yjvcyg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
			tinymce.init({
				selector: "textarea",
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			});
	</script>
</head>

<body>
<div id="wrapper">
	<?php include('menu.php');?>

	<h2>Edit Post</h2>

	<?php
	// if form has been submitted process it
	if(isset($_POST['submit'])) {

		$_POST = array_map( 'stripslashes', $_POST );

		// collect form data
		extract($_POST);

		// basic validation
		if($postID =='') {
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle =='') {
			$error[] = 'Please enter the title.';
		}

		if($postDescription =='') {
			$error[] = 'Please enter the description.';
		}

		if($postContent =='') {
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)) {

			try {

				// insert into database
				$sqlquery = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDescription = :postDescription, postContent = :postContent WHERE postID = :postID') ;
				$sqlquery->execute(array(
					':postTitle' => $postTitle,
					':postDescription' => $postDescription,
					':postContent' => $postContent,
					':postID' => $postID
				));

				// redirect to index page
				header('Location: index.php?action=updated');
				exit;

			}
			catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}
	}
	?>

	<?php
	// check for any errors
	if(isset($error)) {
		foreach($error as $error) {
			echo $error.'<br />';
		}
	}

		try {
			$sqlquery = $db->prepare('SELECT postID, postTitle, postDescription, postContent FROM blog_posts WHERE postID = :postID') ;
			$sqlquery->execute(array(':postID' => $_GET['id']));
			$row = $sqlquery->fetch(); 
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>

	<form action='' method='post'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDescription' cols='60' rows='10'><?php echo $row['postDescription'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postContent' cols='60' rows='10'><?php echo $row['postContent'];?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>
</body>
</html>