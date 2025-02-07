<?php
//Start session
session_start();
define('SITEURL', 'http://localhost:808/project%20ii/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD', 'root');
define('DB_NAME','projectii');
$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_connect_error());
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_connect_error());
?>
