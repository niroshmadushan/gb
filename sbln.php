



<?php
session_start();


if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
    
}
$conn = mysqli_connect("localhost","root","","gbdb"); 
$todayDate = date('Y-m-d');
if (isset($_POST['submit']) ||!empty($_POST['submit'])) {
    $todayDate = $_POST['wd'];
    $reg=$_POST['reg'];
   
    $amt=$_POST['amt'];

    
    
    $query="INSERT INTO `share_tr`(`des`, `date`, `amount`, `regno`) VALUES ('cr','$todayDate','$amt','$reg')";
    if ($conn->query($query) === TRUE) {

        echo "
      

        <style>
        .msgbox{display: none;}
        .msgbox2{display: block;}
        
        </style>
        <script> window.location.href = 'trnsuc.php';</script>
       
        ";
    } else {
        echo "<p class='err'>Error: " . $query . "<br>" . $conn->error."</p>";
     
    }



}




?>

