<?php 


session_start();

// Check if the user is not logged in
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

$totaldep=null;
$totalwid=null;
$total=null;


$query="SELECT `regno` FROM `temp`;"; 
$result = $conn->query($query); 

     while($row = $result->fetch_assoc()) { 
         $data[] = $row;  
     }
foreach ($data as $row) {
    $reg=$row['regno'];
    $todayDate = date('Y');
    $month= date('m');
    $m=intval($month);
   



$end="$todayDate-12-31";
$start="$todayDate-01-01";
$query="SELECT sum(amount)  as total FROM `share_tr` WHERE regno='$reg' and date BETWEEN '$start' and '$end'  and des='dr';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totaldep = $row['total'];

 $query="SELECT sum(amount)  as total FROM `share_tr` WHERE regno='$reg' and date BETWEEN '$start' and '$end' and des='cr';";
 $result = $conn->query($query);
 $row = $result->fetch_assoc();
 $totalwid = $row['total'];
 $total=$totaldep-$totalwid;

 $query="UPDATE `account` SET `s_cr_dr`='$total' WHERE regno='$reg';";
 mysqli_query($conn,$query);

 $end="$todayDate-12-31";
$start="$todayDate-01-01";
$query="SELECT sum(amount)  as total FROM `normal_tr` WHERE regno='$reg' and date BETWEEN '$start' and '$end'  and des='dr';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totaldep = $row['total'];

 $query="SELECT sum(amount)  as total FROM `normal_tr` WHERE regno='$reg' and date BETWEEN '$start' and '$end' and des='cr';";
 $result = $conn->query($query);
 $row = $result->fetch_assoc();
 $totalwid = $row['total'];
 $total=$totaldep-$totalwid;

 $query="UPDATE `account` SET `cr_dr`='$total' WHERE regno='$reg';";
 mysqli_query($conn,$query);


}

echo"
<script>
// JavaScript redirect
window.location.href = 'updata6.php';
</script>
";
?>