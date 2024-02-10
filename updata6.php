<?php
session_start();

//Check if the user is not logged in
if (!isset($_SESSION['username'])) {
   // Redirect to the login page
   header("Location: index.php");
   exit();
   
}


$conn = mysqli_connect("localhost","root","","gbdb");
$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$tt = $row['total'];



$query="SELECT t.regno,`q1`, `q2`, `q3`, `q4`, `cr_dr`, `s_year`, `op_bln` FROM `temp` t JOIN account a on t.regno=a.regno;";

$result = $conn->query($query); 
while($row = $result->fetch_assoc()) { 
$datax[] = $row;  
}

foreach ($datax as $row) {
    $q1 = floatval($row['q1']);   
    $q2 = floatval($row['q2']);   
    $q3 = floatval($row['q3']);   
    $q4 = floatval($row['q4']);
    $crdr= floatval($row['cr_dr']);   
    $syear=  floatval($row['s_year']); 
    $stbln=  floatval($row['op_bln']); 
    
    
       $reg=floatval($row['regno']);   
     
      

    
    $tobln=$q1+$q2+$q3+$q4+$crdr+$syear+$stbln;

    $query="UPDATE `account` SET `en_bln`='$tobln' WHERE regno='$reg';";
    mysqli_query($conn,$query);
}
   mysqli_close($conn);
   echo"
<script>
// JavaScript redirect
window.location.href = 'logsuc.php';
</script>
";
?>