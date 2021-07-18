<?php
// include config
require_once('../includes/config.php');

include '../navbar.php';
// log user out
$user->logout();
header('Location: index.php'); 

?>