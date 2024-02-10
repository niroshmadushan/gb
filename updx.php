<?php
session_start();

//Check if the user is not logged in
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

echo"
<center>
<h4>Updating Database</h4><hr><div id='myProgressBar'>
    <progress id='progress' value='0' max='100'></progress>
</div><span id='out'></span></center>
<style>
        /* Optional: Add some styling to the progress bar */
        #myProgressBar {
            width: 600px;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            
        }
        #progress{
            width: 400px;
            height:25px
        }
    </style>
";
$conn = mysqli_connect("localhost","root","","gbdb"); 
$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$tt = $row['total'];

    $query="SELECT regno FROM `tmp` ORDER by regno asc limit 1;";
    $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data[] = $row;  
     }
     foreach ($data as $row) {
        $reg=$row['regno'];}
     $query="DELETE FROM `temp`;";   
     mysqli_query($conn,$query);
    $query="INSERT INTO `temp`(`regno`) VALUES ('$reg')";
    mysqli_query($conn,$query);

    $query="DELETE FROM `tmp` ORDER by regno asc limit 1;";
    $result = $conn->query($query); 

   
    $prc=(($reg/$tt)*100);
    $prct=round(($prc),1);
    echo "<script>
var progressBar = document.getElementById('progress');
var span = document.getElementById('out');
progressBar.value = $prc;
span.innerHTML='New Year Balance Update : $prct%  please wait...'

   
   


</script>";

        echo"Updated REG NO: $reg";
        if($prct==100){

            echo"
            <script>
            alert('$prct');
            // JavaScript redirect
            window.location.href = 'updata1.php';
            </script>
            ";
        }

?>






<?php



$rt1=null;
$rt2=null;
$rt3=null;
$rt4=null;
$drt1 = array();
$drt2 = array();
$drt3 = array();
$drt4 = array();
$todayDate = date('Y');
$qrt1="$todayDate-01-02";
$qrt2="$todayDate-04-02";
$qrt3="$todayDate-07-02";
$qrt4="$todayDate-10-02";
$conn = mysqli_connect("localhost","root","","gbdb");



$q="SELECT `rate` FROM `n_rate` WHERE date<'$qrt1' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt1[] = $row;  
         }
         foreach ($drt1 as $row) {
             $rt = floatval($row['rate']);
             $rt1=($rt/4/100);        
         }
$q="SELECT `rate` FROM `n_rate` WHERE date<'$qrt2' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt2[] = $row;  
         }
         foreach ($drt2 as $row) {
             $rt = floatval($row['rate']);
             $rt2=($rt/4/100);        
         }

$q="SELECT `rate` FROM `n_rate` WHERE date<'$qrt3' ORDER by id DESC limit 1;";
         $result = $conn->query($q); 
        while($row = $result->fetch_assoc()) { 
         $drt3[] = $row;  
         }
         foreach ($drt3 as $row) {
             $rt = floatval($row['rate']);
             $rt3=($rt/4/100);        
         }
$q="SELECT `rate` FROM `n_rate` WHERE date<'$qrt4' ORDER by id DESC limit 1;";
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
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt1' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt1' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt1),2);
         
           $query="UPDATE `account` SET `q1`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
          
        }
        
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt2' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt2' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt2),2);
           
           $query="UPDATE `account` SET `q2`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           

        }
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt3' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt3' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt3),2);
           
           $query="UPDATE `account` SET `q3`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           
            

        }
        foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt4' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `normal_tr` WHERE regno='$reg' and date<'$qrt4' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt4),2);
           
           $query="UPDATE `account` SET `q4`='$totrt' WHERE regno='$reg';";
           mysqli_query($conn,$query);
         
           

        }

?>
<?php

$rt1=null;
$rt2=null;
$rt3=null;
$rt4=null;
$rt5=null;
$rt6=null;
$rt7=null;
$rt8=null;
$rt9=null;
$rt10=null;
$rt11=null;
$rt12=null;
$drt1 = array();
$drt2 = array();
$drt3 = array();
$drt4 = array();
$drt5 = array();
$drt6 = array();
$drt7 = array();
$drt8 = array();
$drt9 = array();
$drt10 = array();
$drt11 = array();
$drt12 = array();

$todayDate = date('Y');
$totalint=null;

$mrt1="$todayDate-01-02";
$mrt2="$todayDate-02-02";
$mrt3="$todayDate-03-02";
$mrt4="$todayDate-04-02";
$mrt5="$todayDate-05-02";
$mrt6="$todayDate-06-02";
$mrt7="$todayDate-07-02";
$mrt8="$todayDate-08-02";
$mrt9="$todayDate-09-02";
$mrt10="$todayDate-10-02";
$mrt11="$todayDate-11-02";
$mrt12="$todayDate-12-02";

$conn = mysqli_connect("localhost","root","","gbdb");
$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$tt = $row['total'];

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt1' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt1=($rt/12/100);        

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt2' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt2=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt3' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt3=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt4' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt4=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt5' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt5=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt6' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt6=($rt/12/100); 

         
         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt7' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt7=($rt/12/100);        

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt8' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt8=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt9' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt9=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt10' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt10=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt11' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt11=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt12' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt12=($rt/12/100);


         $query="SELECT `regno` FROM `temp`;";
         $result = $conn->query($query); 
         while($row = $result->fetch_assoc()) { 
         $regdt[] = $row;  
         $totalint=null;
         
         }
         foreach ($regdt as $row) {
            $reg = $row['regno'];
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt1),2);
      
           $totalint=$totalint+$totrt;
           
         

        
            
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt2),2);
          
           $totalint=$totalint+$totrt;
          

        
          
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt3),2);
          
           $totalint=$totalint+$totrt;
          

       
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt4),2);
           
           $totalint=$totalint+$totrt;
           

      
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt5),2);
         
           $totalint=$totalint+$totrt;
         

      
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt6),2);
          
           $totalint=$totalint+$totrt;
         
       
           
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt7),2);
          
           $totalint=$totalint+$totrt;
          

       
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt8),2);
          
           $totalint=$totalint+$totrt;
          

     
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt9),2);
          
           $totalint=$totalint+$totrt;
          

    
     
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt10),2);
         
           $totalint=$totalint+$totrt;
          

     

           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt11),2);
           
           $totalint=$totalint+$totrt;
          

      
         
           $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt12' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt12' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt12),2);
          
           $totalint=$totalint+$totrt;
           $totalint=round(($totalint-0.04),2);
       
           $query="UPDATE `account` SET `s_year`='$totalint' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           $totalint=null;
        }


  ?>
  <?php

$conn = mysqli_connect("localhost","root","","gbdb");
$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$tt = $row['total'];

$todaymonth = date('m');


$query="SELECT t.regno,`q1`, `q2`, `q3`, `q4` FROM `temp` t JOIN account a on t.regno=a.regno;";
$result = $conn->query($query); 
while($row = $result->fetch_assoc()) { 
$regdtt[] = $row;  
}
$tot=null;
if($todaymonth<4){
    
    foreach ($regdtt as $row) {
        $reg = $row['regno'];
        $q1 = $row['q1'];
        $query="UPDATE `account` SET `n_real`='$q1' WHERE regno='$reg';";
        $prc=(($reg/$tt)*100);
       
      
        mysqli_query($conn,$query);
    }
}else{
    if($todaymonth<7){
    
        foreach ($regdtt as $row) {
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
    
            foreach ($regdtt as $row) {
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
            
    
                foreach ($regdtt as $row) {
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
?>

<?php


$rt1=null;
$rt2=null;
$rt3=null;
$rt4=null;
$rt5=null;
$rt6=null;
$rt7=null;
$rt8=null;
$rt9=null;
$rt10=null;
$rt11=null;
$rt12=null;
$drt1 = array();
$drt2 = array();
$drt3 = array();
$drt4 = array();
$drt5 = array();
$drt6 = array();
$drt7 = array();
$drt8 = array();
$drt9 = array();
$drt10 = array();
$drt11 = array();
$drt12 = array();
$regdt = array();

$todayDate = date('Y');
$totalint=0;
$lastyear=(intval($todayDate))-1;


$mrt1="$lastyear-12-31";
$mrt2="$todayDate-01-31";
$mrt3="$todayDate-02-31";
$mrt4="$todayDate-03-31";
$mrt5="$todayDate-04-31";
$mrt6="$todayDate-05-31";
$mrt7="$todayDate-06-31";
$mrt8="$todayDate-07-31";
$mrt9="$todayDate-08-31";
$mrt10="$todayDate-09-31";
$mrt11="$todayDate-10-31";
$mrt12="$todayDate-11-31";

$conn = mysqli_connect("localhost","root","","gbdb");
$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$tt = $row['total'];

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt1' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt1=($rt/12/100);        

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt2' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt2=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt3' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt3=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt4' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt4=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt5' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt5=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt6' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt6=($rt/12/100); 

         
         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt7' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt7=($rt/12/100);        

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt8' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt8=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt9' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt9=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt10' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt10=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt11' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt11=($rt/12/100); 

         $q="SELECT `rate` FROM `s_rate` WHERE date<'$mrt12' ORDER by id DESC limit 1;";
         $result = $conn->query($q);
         $row = $result->fetch_assoc();
         $rt = $row['rate']; 
         $rt12=($rt/12/100);


         $query="SELECT `regno` FROM `temp`;";
         $result = $conn->query($query); 
         while($row = $result->fetch_assoc()) { 
         $regdt[] = $row;  
         }


         $todaymonth = floatval(date('m'))-1;
      

         if($todaymonth==1){
            foreach ($regdt as $row) {
                $reg = $row['regno'];
               $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
               $result = $conn->query($query);
               $row = $result->fetch_assoc();
               $totaldr = $row['totaldr'];
               $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
               $result = $conn->query($query);
               $row = $result->fetch_assoc();
               $totalcr = $row['totalcr'];
               $totrt=round((($totaldr-$totalcr)*$rt1),2);
               
               $totalint=$totalint+$totrt;
               if($totalint>0){
               $totalint=round(($totalint-0.0033),2);}

               $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
                 mysqli_query($conn,$query);
            }
            
         }
        if($todaymonth==2){

            foreach ($regdt as $row) {
               $reg = $row['regno'];
               $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
               $result = $conn->query($query);
               $row = $result->fetch_assoc();
               $totaldr = $row['totaldr'];
               $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
               $result = $conn->query($query);
               $row = $result->fetch_assoc();
               $totalcr = $row['totalcr'];
               $totrt=round((($totaldr-$totalcr)*$rt1),2);
              
               $totalint=$totalint+$totrt;
              
             


               $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totaldr = $row['totaldr'];
           $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
           $result = $conn->query($query);
           $row = $result->fetch_assoc();
           $totalcr = $row['totalcr'];
           $totrt=round((($totaldr-$totalcr)*$rt2),2);
          
           $totalint=$totalint+$totrt;
           if($totalint>0){
           $totalint=round(($totalint-0.0066),2);}

               $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
                 mysqli_query($conn,$query);

            }
            
         }
         if($todaymonth==3){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
       
            $totalint=$totalint+$totrt;
            
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0099),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }  
         }
         if($todaymonth==4){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
            
            $totalint=$totalint+$totrt;
         


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0132),2);}

            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
            
         }
         if($todaymonth==5){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
           
            $totalint=$totalint+$totrt;
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0165),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
         }
         if($todaymonth==6){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
         
            $totalint=$totalint+$totrt;
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0198),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
         }
         if($todaymonth==7){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
           
            $totalint=$totalint+$totrt;
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0231),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
         }
         if($todaymonth==8){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
          
            $totalint=$totalint+$totrt;
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt8),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0234),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
            
         }
         if($todaymonth==9){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
           
            $totalint=$totalint+$totrt;
           


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt8),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt9),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.0297),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
        
            }
            
         }
         if($todaymonth==10){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
           
            $totalint=$totalint+$totrt;
          


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt8),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt9),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt10),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.033),2);}

            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
        
            }
         }
         if($todaymonth==11){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
            
            $totalint=$totalint+$totrt;
            


            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt8),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt9),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt10),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt11),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.036),2);}
            $query="UPDATE `account` SET `s_real`='$totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
        
            }
         }
         if($todaymonth==12){
            foreach ($regdt as $row) {
            $reg = $row['regno'];
            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='dr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totaldr = $row['totaldr'];
            $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt1' and des='cr';";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $totalcr = $row['totalcr'];
            $totrt=round((($totaldr-$totalcr)*$rt1),2);
            
            $totalint=$totalint+$totrt;
           

            $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt2' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt2),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt3' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt3),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt4' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt4),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt5' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt5),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt6' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt6),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt7' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt7),2);
       
        $totalint=$totalint+$totrt;

        
        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt8' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt8),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt9' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt9),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt10' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt10),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt11' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt11),2);
       
        $totalint=$totalint+$totrt;

        $query="SELECT SUM(amount) as totaldr FROM `share_tr` WHERE regno='$reg' and date<'$mrt12' and des='dr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totaldr = $row['totaldr'];
        $query="SELECT SUM(amount) as totalcr FROM `share_tr` WHERE regno='$reg' and date<'$mrt12' and des='cr';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalcr = $row['totalcr'];
        $totrt=round((($totaldr-$totalcr)*$rt11),2);
       
        $totalint=$totalint+$totrt;
        if($totalint>0){
        $totalint=round(($totalint-0.039),2);}
            $query="UPDATE `account` SET `s_real`=' $totalint' WHERE regno='$reg';";
              mysqli_query($conn,$query);
            }
            
         }

?>

<?php 



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
?>

<?php



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
    $query="UPDATE `temp2` SET `run`='1';";
    mysqli_query($conn,$query);
}
   

   mysqli_close($conn);
   echo"
<script>
// JavaScript redirect
window.location.href = 'updx.php';
</script>
";
?>