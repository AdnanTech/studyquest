<?php require('includes/config.php'); 

include 'navbar.php';

$stmt = $db->prepare('SELECT postID, postTitle, postContent, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

// if post does not exists redirect user.
if($row['postID'] == ''){
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/upgrade.css">
</head>
<body>

    <div id="wrapper">

        <?php   
            echo '<div>';
                echo '<h1>'.$row['postTitle'].'</h1>';
                echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postContent'].'</p>';
            echo '</div>';
        ?>

    </div>

</body>
</html>