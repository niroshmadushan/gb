

<?php 
session_start();

//Check if the user is not logged in
if (!isset($_SESSION['username'])) {
   // Redirect to the login page
   header("Location: index.php");
   exit();
   
}
$conn = mysqli_connect("localhost","root","","gbdb"); 
 $query="DELETE FROM `tmp`;";   
 mysqli_query($conn,$query);

$query="INSERT INTO tmp (regno) SELECT regno FROM register;";
mysqli_query($conn,$query);
mysqli_close($conn);

echo"
        <script>
        // JavaScript redirect
        window.location.href = 'updx.php';
    </script>
        ";

?>

