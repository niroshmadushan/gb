<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
    
}
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gbdb';

// Get the current date and time
$currentDateTime = date('Y-m-d_H-i-s');

// Create a backup file name with the current date and time
$backupFile = "C:\\xampp\\htdocs\\sqlbackup\\{$currentDateTime}.sql";

// Command to create a full backup of the gbdb database
$command = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$backupFile}";

// Execute the command
exec($command);

?>

