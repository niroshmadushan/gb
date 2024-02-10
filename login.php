<?php



session_start();



// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gbdb';

// Get the current date and time
$currentDateTime = date('Y-m-d_H-i-s');

// Create a backup file name with the current date and time
$backupFile = "C:\\xampp\\htdocs\\pro\\sqlbackup\\{$currentDateTime}.sql";

// Command to create a full backup of the gbdb database
$command = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$backupFile}";

// Execute the command
exec($command);
echo"tetfyfsdyhastfdv";
// Check if the form is submitted

    // Perform your authentication logic here
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example: Check if the username and password match
    if ($username === 'admin' && $password === 'admin') {
        // Set the username in the session to mark the user as logged in
        $_SESSION['username'] = $username;

        // Redirect to the dashboard
        
        header("Location: dash.php");
        exit();
    } else {
        // Authentication failed, you may want to display an error message
        echo"<script> Please Enter Valid User Name & Password </script>";
        header("Location: index.php");
    }


?>