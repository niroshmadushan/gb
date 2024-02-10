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
$regdt = array();

$todayDate = date('Y');
$totalint=0;
$lastyear=(intval($todayDate))-1;


$mrt1="$todayDate-01-31";
$mrt2="$todayDate-02-31";
$mrt3="$todayDate-03-31";
$mrt4="$todayDate-04-31";
$mrt5="$todayDate-05-31";
$mrt6="$todayDate-06-31";
$mrt7="$todayDate-07-31";
$mrt8="$todayDate-08-31";
$mrt9="$todayDate-09-31";
$mrt10="$todayDate-10-31";
$mrt11="$todayDate-11-31";
$mrt12="$todayDate-12-31";

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


         echo"
         <script>
         // JavaScript redirect
         window.location.href = 'upn7.php';
         </script>
         ";

?>