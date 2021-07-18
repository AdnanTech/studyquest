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
    <title>Admin - Add User</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
</head>

<body>
<div id="wrapper">
    <?php include('menu.php');?>

    <h2>Add User</h2>

    <?php

    // if form has been submitted process it
    if(isset($_POST['submit'])) {

        // collect form data
        extract($_POST);

        // basic validation
        if($Username =='') {
            $error[] = 'Please enter the Username.';
        }

        if($password =='') {
            $error[] = 'Please enter the password.';
        }

        if($passwordConfirm =='') {
            $error[] = 'Please confirm the password.';
        }

        if($password != $passwordConfirm) {
            $error[] = 'Passwords do not match.';
        }

        if(!isset($error)) {
            $hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

            try 
            {
                // insert into database
                $stmt = $db->prepare('INSERT INTO blog_members (Username,Password) VALUES (:Username, :Password)');
                $stmt->execute(array(
                    ':Username' => $Username,
                    ':Password' => $hashedpassword,
                ));

                // redirect to index page
                header('Location: users.php?action=added');
                exit;
            } catch(PDOException $e) 
            {
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

        <p><label>Username</label><br />
        <input type='text' name='Username' value='<?php if(isset($error)){ echo $_POST['Username'];}?>'></p>

        <p><label>Password</label><br />
        <input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

        <p><label>Confirm Password</label><br />
        <input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>
        
        <p><input type='submit' name='submit' value='Add User'></p>

    </form>
</div>
</body>
