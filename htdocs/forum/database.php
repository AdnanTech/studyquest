<?php 
session_start();

// database connection creation

include 'connect.php';
$connect_database = mysqli_connect($server, $username, $password, $database, $port);

if(!mysqli_connect($server, $username, $password, $database, $port))
{
 	exit('Error: could not establish database connection');
}

/*if(!mysqli_select_db($database, $server))
{
 	exit('Error: could not select the database');
}*/
?>