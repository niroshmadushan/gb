<?php
session_start();


// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
    
}
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

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: index.php");
exit();
?>
