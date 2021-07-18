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
    <title>Admin - Add Post</title>
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
    <h2>Add Post</h2>

    <?php

    // if form has been submitted process it
    if(isset($_POST['submit'])) {

        $_POST = array_map( 'stripslashes', $_POST );

        // collect form data
        extract($_POST);

        // basic validation
        if($PostTitle =='') {
            $error[] = 'Please enter the title.';
        }

        if($PostDescription =='') {
            $error[] = 'Please enter the description.';
        }

        if($PostContent =='') {
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)) {

            try {

                // insert into database
                $stmt = $db->prepare('INSERT INTO blog_posts (PostTitle,PostDescription,PostContent,PostDate) VALUES (:PostTitle, :PostDescription, :PostContent, :PostDate)') ;
                $stmt->execute(array(
                    ':PostTitle' => $PostTitle,
                    ':PostDescription' => $PostDescription,
                    ':PostContent' => $PostContent,
                    ':PostDate' => date('Y-m-d H:i:s')
                ));

                // redirect to index page
                header('Location: index.php?action=added');
                exit;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    // check for any errors
    if(isset($error)) {
        foreach($error as $error) {
            echo '<p class="error">'.$error.'</p>';
        }
    }
    ?>

    <form action='' method='post'>

        <p><label>Title</label><br />
        <input type='text' name='PostTitle' value='<?php if(isset($error)){ echo $_POST['PostTitle'];}?>'></p>

        <p><label>Description</label><br />
        <textarea name='PostDescription' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['PostDescription'];}?></textarea></p>

        <p><label>Content</label><br />
        <textarea name='PostContent' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['PostContent'];}?></textarea></p>

        <p><input type='submit' name='submit' value='Submit'></p>

    </form>
</div>
</body>
