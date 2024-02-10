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

$todaymonth = date('m');


$query="SELECT t.regno,`q1`, `q2`, `q3`, `q4` FROM `temp` t JOIN account a on t.regno=a.regno;";
$result = $conn->query($query); 
while($row = $result->fetch_assoc()) { 
$regdt[] = $row;  
}
$tot=null;
if($todaymonth<4){
    
    foreach ($regdt as $row) {
        $reg = $row['regno'];
        $q1 = $row['q1'];
        $query="UPDATE `account` SET `n_real`='$q1' WHERE regno='$reg';";
        $prc=(($reg/$tt)*100);
       
      
        mysqli_query($conn,$query);
    }
}else{
    if($todaymonth<7){
    
        foreach ($regdt as $row) {
            $reg = $row['regno'];

            $q1 = floatval($row['q1']);  
            $q2 = floatval($row['q2']);  
            $tot=$q1+$q2;
            $prc=(($reg/$tt)*100);
       
        mysqli_query($conn,$query);
            $query="UPDATE `account` SET `n_real`='$tot' WHERE regno='$reg';";
            mysqli_query($conn,$query);
        }
    }else{
    
        if($todaymonth<10){
    
            foreach ($regdt as $row) {
                $reg = $row['regno'];
    
                $q1 = floatval($row['q1']);  
                $q2 = floatval($row['q2']);  
                $q3 = floatval($row['q3']);  
                $tot=$q1+$q2+$q3;
                $prc=(($reg/$tt)*100);
       
       
        mysqli_query($conn,$query);
                
                $query="UPDATE `account` SET `n_real`='$tot' WHERE regno='$reg';";
                mysqli_query($conn,$query);
            }
        }else{
            
    
                foreach ($regdt as $row) {
                    $reg = $row['regno'];
                    $prc=(($reg/$tt)*100);
       
        
                    $q1 = floatval($row['q1']);  
                    $q2 = floatval($row['q2']);  
                    $q3 = floatval($row['q3']);  
                    $q4 = floatval($row['q4']);  
                  
                    $tot=$q1+$q2+$q3+$q4;
                    $prc=(($reg/$tt)*100);
       
       
        mysqli_query($conn,$query);
                    
                    $query="UPDATE `account` SET `n_real`='$tot' WHERE regno='$reg';";
                    mysqli_query($conn,$query);
                }
            
            
                
            
            
        }
        
    }


}
echo"
<script>
// JavaScript redirect
window.location.href = 'upn5.php';
</script>
";


?>