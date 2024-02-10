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
$totalint=0;

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
          
           if($totalint>0){
            $totalint=round(($totalint-0.04),2);}
           $query="UPDATE `account` SET `s_year`='$totalint' WHERE regno='$reg';";
           mysqli_query($conn,$query);
        }

        echo"
        <script>
        // JavaScript redirect
        window.location.href = 'u4.php';
    </script>
        ";


  ?>