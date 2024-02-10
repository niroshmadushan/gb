<?php
session_start();

//Check if the user is not logged in
if (!isset($_SESSION['username'])) {
   // Redirect to the login page
   header("Location: index.php");
   exit();
   
}


$rt1=null;
$rt2=null;
$rt3=null;
$rt4=null;
$drt1 = array();
$drt2 = array();
$drt3 = array();
$drt4 = array();
$todayDate = date('Y');
$qrt4="$todayDate-12-31";
$qrt1="$todayDate-03-31";
$qrt2="$todayDate-06-31";
$qrt3="$todayDate-09-31";
$conn = mysqli_connect("localhost","root","","gbdb");



$q="SELECT `rate` FROM `n_rate` WHERE date<='$qrt1' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt1[] = $row;  
         }
         foreach ($drt1 as $row) {
             $rt = floatval($row['rate']);
             $rt1=($rt/4/100);        
         }
$q="SELECT `rate` FROM `n_rate` WHERE date<='$qrt2' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt2[] = $row;  
         }
         foreach ($drt2 as $row) {
             $rt = floatval($row['rate']);
             $rt2=($rt/4/100);        
         }

$q="SELECT `rate` FROM `n_rate` WHERE date<='$qrt3' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt3[] = $row;  
         }
         foreach ($drt3 as $row) {
             $rt = floatval($row['rate']);
             $rt3=($rt/4/100);        
         }
$q="SELECT `rate` FROM `n_rate` WHERE date<='$qrt4' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt4[] = $row;  
         }
         foreach ($drt4 as $row) {
             $rt = floatval($row['rate']);
             $rt4=($rt/4/100);        
         }         


$regdt = array();
$totaldr=null;
$totalcr=null;
$totrt=null;

$query="SELECT `regno` FROM `temp`;";
$result = $conn->query($query); 
        while($row = $result->fetch_assoc()) { 
         $regdt[] = $row;  
         }
         foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt1' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt1' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt1),2);
         
           $query="UPDATE `account` SET `q1`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
          
        }
        
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt2' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt2' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt2),2);
           
           $query="UPDATE `account` SET `q2`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           

        }
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt3' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt3' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt3),2);
           
           $query="UPDATE `account` SET `q3`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           
            

        }
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt4' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<='$qrt4' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt4),2);
           
           $query="UPDATE `account` SET `q4`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
         
           

        }


        echo"
        <script>
        // JavaScript redirect
        window.location.href = 'updata3.php';
    </script>
        ";




?>