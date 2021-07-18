<?php
ob_start();
session_start();

// Database credentials
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS', '');
define('DBNAME', 'studyquest');
define('PORT', '3307');

$db = new PDO("mysql:host=".DBHOST.";port=".PORT.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// set timezone
date_default_timezone_set('Europe/London');

// Load classes as needed
spl_autoload_register(function ($class) {
   
    $class = strtolower($class);
 
     // if call from within assets adjust the path
    $classpath = 'classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
       require_once $classpath;
     } 	
     
     // if call from within admin adjust the path
    $classpath = '../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
       require_once $classpath;
     }
     
     // if call from within admin adjust the path
    $classpath = '../../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
       require_once $classpath;
     } 		
      
});
 
$user = new User($db);
?>