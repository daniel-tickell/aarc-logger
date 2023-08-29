<?php
// Basic connection settings
$databaseHost = '127.0.0.1';
$databaseUsername = 'root';
$databasePassword = 'CHANGEME';
$databaseName = 'danlogger';

// Connect to the database
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
?>
