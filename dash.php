<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();


}
$run="";
$dataxx = array();
$data1 = array();
$data2 = array();
$data3 = array();
$data4 = array();
$data5 = array();
$data6 = array();
$dataan = array();
$updateyear=null;
$cr=null;
$dr=null;
$slct1=null;
$slct2=null;
$slct3=null;
$slct4=null;
$regwx=null;
$regw=null;
$namew=null;
$regs=null;
$names=null;
$crdrw=null;
$adds=null;
$en=null;
$enbln=null;
$stbln=null;
$blnc=null;
$data = array();
$datax = array();
$datax2 = array();
$dataerror= array();
$dataerror2= array();
$seq=null;
$des=null;
$val=null;
$dte=null;
$reg="";
$reg1="";
$reg2="";
$reg3="";
$name="";
$add="";
$note="";
$name1="";
$name2="";
$add1="";
$note1="";
$conn = mysqli_connect("localhost","root","","gbdb"); 

$qt1='';
$qt2='';
$qt3='';
$qt4='';

$crdr="";
$sy="";
$sr="";
$ob="";
$eb="";
$nr="";

$srt=null;
$nrt=null;
$reg125='';



$query="SELECT  `rate` FROM `n_rate` ORDER by id desc limit 1;";
$result = $conn->query($query); 
while($row = $result->fetch_assoc()) { 
    $data125[] = $row;  
}
foreach ($data125 as $row) {
    $nrt = $row['rate'];}
    
$query="SELECT  `rate` FROM `s_rate` ORDER by id desc limit 1;";
$result = $conn->query($query); 
while($row = $result->fetch_assoc()) { 
        $data125[] = $row;  
}
foreach ($data125 as $row) {
    $srt = $row['rate'];}




echo"<style> 
.update{display:none;}
#up{display: none;}
#rate{display: none;}
.reg{display: none;} 
.deposite{display: none;}
.withdrawal{display: none;}
.datatable{display: none;}
.sbln{display: none;}
.nbln{display: none;}


</style>";
$normaldeposite=null;
$normalwithdrawal=null;
$normalbalance=null;
$nbalance=null;
$sharedeposite=null;
$sharewithdrawal=null;
$sharebalance=null;
$sbalance=null;
$regcus=null;
$totalsnbalance=null;
$ttlsnbalance=null;
$totalshareint=null;
$totalnormalint=null;
$totalint=null;
$intbalance=null;
$openbalance=null;
$lastbalance=null;
$normalastbalance=null;
$totalsharebalance=null;
$totalopensharebalnce=null;
$totalnormalshare=null;
//==============data analayse area================


$todayDate = date('Y');
$py = (floatval($todayDate))-1;  
$ny = (floatval($todayDate))+1;  
$pry="$py-12-31";
$ney="$ny-01-01";

$queryx="SELECT count(regno) as tot FROM `register`;";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataan[] = $rowx;  
}
foreach ($dataan as $rowx) {
    $regcus =$rowx['tot'];}


$queryx="SELECT sum(amount) as tot FROM `normal_tr` WHERE des='dr' and  date<'$ney' and date >'$pry';";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataan[] = $rowx;  
}
foreach ($dataan as $rowx) {
    $normaldeposite =round(($rowx['tot']),2);}


$queryx="SELECT sum(amount) as tot FROM `normal_tr` WHERE des='cr' and  date<'$ney' and date >'$pry';";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataan[] = $rowx;  
}
foreach ($dataan as $rowx) {
    $normalwithdrawal =round(($rowx['tot']),2);}

$normalbalance=$normaldeposite-$normalwithdrawal;

$nbalance=$normalbalance;



$queryx="SELECT sum(amount) as tot FROM `share_tr` WHERE des='dr' and  date<'$ney' and date >'$pry';";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataan[] = $rowx;  
}
foreach ($dataan as $rowx) {
    $sharedeposite =round(($rowx['tot']),2);}


$queryx="SELECT sum(amount) as tot FROM `share_tr` WHERE des='cr' and  date<'$ney' and date >'$pry';";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataan[] = $rowx;  
}
foreach ($dataan as $rowx) {
    $sharewithdrawal =round(($rowx['tot']),2);}

$sharebalance=$sharedeposite-$sharewithdrawal;
$sbalance=$sharebalance;

$totalsnbalance=$nbalance+$sbalance;
$ttlsnbalance=$totalsnbalance;


$queryx="SELECT sum(q1) as q1, sum(q2) as q2 , sum(q3) as q3, sum(q4) as q4  FROM `account`;";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataanx[] = $rowx;  
}
foreach ($dataanx as $rowx) {
    $qz1 =round(($rowx['q1']),2);
    $qz2 =round(($rowx['q2']),2);
    $qz3 =round(($rowx['q3']),2);
    $qz4 =round(($rowx['q4']),2);
}
$totalnormalint=round(($qz1+$qz2+$qz3+$qz4),2);

$queryx="SELECT sum(s_year) as tot FROM `account`;";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
    $dataanz[] = $rowx;  
}
foreach ($dataanz as $rowx) {
    $totalshareint =round(($rowx['tot']),2);}

    $queryx="SELECT sum(op_bln) as tot FROM `account`;";
    $resultx = $conn->query($queryx); 
    while($rowx = $resultx->fetch_assoc()) { 
        $dataanc[] = $rowx;  
    }
    foreach ($dataanc as $rowx) {
        $openbalance =round(($rowx['tot']),2);}


        $normalastbalance=$openbalance+$nbalance;
     


    $totalint=round(($totalshareint+$totalnormalint),2);
    $intbalance=round(($nbalance+$totalint),2);
    $lastbalance=round(($openbalance+$intbalance),2);

    $normalwithdrawal="($normalwithdrawal)";
    $sharewithdrawal="($sharewithdrawal)";

    $queryx="SELECT sum(amount) as tot FROM `share_tr`;";

    $resultx = $conn->query($queryx); 
    while($rowx = $resultx->fetch_assoc()) { 
        $dataanc[] = $rowx;  
    }
    foreach ($dataanc as $rowx) {
        $totalsharebalance =round(($rowx['tot']),2);}
        $totalopensharebalnce= $totalsharebalance-$sbalance;


       $totalnormalshare= $totalsharebalance+$normalastbalance;
        $totalasttblnc=$normalastbalance+$totalint;



        $queryx="SELECT `year` FROM `update_tbl`;";
        $resultx = $conn->query($queryx); 
    while($rowx = $resultx->fetch_assoc()) { 
        $dataancx[] = $rowx;  
    }
    foreach ($dataancx as $rowx) {
        $updateyear =($rowx['year']);}
//====================================================

if (isset($_POST['search1']) ||!empty($_POST['search1'])) {
    echo"<style> 
    .wel{display: none;} 
    #up{display: block;} </style>";
    $conn = mysqli_connect("localhost","root","","gbdb"); 
    $reg12=$_POST['reg'];
    $query="SELECT * FROM `register` WHERE regno='$reg12';"; 
        $result = $conn->query($query); 
        
             while($row = $result->fetch_assoc()) { 
                 $data[] = $row;  
             }

             foreach ($data as $row) {
                $reg125=$row['regno'];
                $name1=$row['name'];
                $add1=$row['address'];
                $note1=$row['note'];
                }
               
       
                
}
$typ=null;
if (isset($_POST['search7']) ||!empty($_POST['search7'])) {
    echo"<style> 
    .wel{display: none;} 
    .update{display: block;}
     </style>";
    $conn = mysqli_connect("localhost","root","","gbdb"); 
    
    $seq=$_POST['seq'];
    $typ=$_POST['selx'];
    $cr=null;$dr=null;  
 if ($typ=="1"){
    $cr=null;$dr=null;  
    $query="SELECT * FROM `share_tr` WHERE seqno='$seq';"; 
        $result = $conn->query($query); 
        
             while($row = $result->fetch_assoc()) { 
                 $dataerror[] = $row;  
             }

             foreach ($dataerror as $row) {
                
                $seq=$row['seqno'];
                $des=$row['des'];
                $val=$row['amount'];
                $dte=$row['date'];
                }
  
                if($des=='dr'){
                        $dr=1;
                }else{
                   $dr=0;
                }
 }
 else{
    $cr=null;$dr=null;  
    $query="SELECT * FROM `normal_tr` WHERE seqno='$seq';"; 
        $result = $conn->query($query); 
       
             while($row = $result->fetch_assoc()) { 
                 $dataerror2[] = $row;  
             }
            
             foreach ($dataerror2 as $row) {
                
                $seq=$row['seqno'];
                $des=$row['des'];
                $val=$row['amount'];
                $dte=$row['date'];
                
                }

                if($des=='dr'){
                    $dr=1;
                }else{
                $dr=0;
                }
         
                    
 }


    
               
                
}
if (isset($_POST['search2']) ||!empty($_POST['search2'])) {
    echo"<style> 
    .wel{display: none;} 
    .deposite{display: block;}
    </style>";
    $conn = mysqli_connect("localhost","root","","gbdb"); 
    $reg3=$_POST['reg'];
    $query="SELECT * FROM `register` WHERE regno='$reg3';"; 
        $result = $conn->query($query); 
        
             while($row = $result->fetch_assoc()) { 
                 $data[] = $row;  
             }

             foreach ($data as $row) {
                $reg3=$row['regno'];
                $name2=$row['name'];
               
                }
               
                
}
if (isset($_POST['search3']) ||!empty($_POST['search3'])) {
    echo"<style> 
    .wel{display: none;} 
    .withdrawal{display: block;}
    </style>";
    $conn = mysqli_connect("localhost","root","","gbdb"); 
    $reg=$_POST['reg'];
    $query="SELECT * FROM `register` WHERE regno='$reg';"; 
        $result = $conn->query($query); 
        
             while($row = $result->fetch_assoc()) { 
                 $data[] = $row;  
             }

             foreach ($data as $row) {
                $regw=$row['regno'];
                $namew=$row['name'];
                $add=$row['address'];
                $note=$row['note'];
                }
               
                
}
if (!isset($_POST['search4']) || empty($_POST['search4'])) {
   
 
    $query="SELECT * FROM `account`a join register r on a.regno=r.regno order by r.regno asc;"; 
    $result = $conn->query($query); 
    
         while($row = $result->fetch_assoc()) { 
             $datax[] = $row;  
         }
        
}else{
    echo"<style> 
    .wel{display: none;} 
    .datatable{display: block;}
    </style>";
    
$conn = mysqli_connect("localhost","root","","gbdb"); 
$tdata=$_POST['reg'];

$query="SELECT * FROM `account`a join register r on a.regno=r.regno WHERE name like '".$tdata."%' or r.regno='".$tdata."' order by r.regno asc ;"; 
$result = $conn->query($query); 

 while($row = $result->fetch_assoc()) { 
     $datax[] = $row;  
 }

if($tdata=="ALL"){
    $conn = mysqli_connect("localhost","root","","gbdb"); 

    $query="SELECT * FROM `account`a join register r on a.regno=r.regno order by r.regno asc;"; 
    $result = $conn->query($query); 
    
         while($row = $result->fetch_assoc()) { 
             $datax[] = $row;  
         }
}




}
$regwx=null;
if (isset($_POST['search5']) ||!empty($_POST['search5'])) {
    $reg=$_POST['reg'];
    $query="DELETE FROM `temp`;";
    mysqli_query($conn,$query);
    $query="INSERT INTO `temp`(`regno`) VALUES ('$reg')";
    mysqli_query($conn,$query);

    $query="SELECT `run` FROM `temp2`;";
    $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data[] = $row;  
     }
     foreach ($data as $row) {
        $run=$row['run'];}




       
if($run=='1'){
  
        $query="UPDATE `temp2` SET `run`='0';";
    mysqli_query($conn,$query);
    $query="SELECT `regno` FROM `temp`;";
    $result = $conn->query($query); 
    $row = $result->fetch_assoc();
    $data = $row['regno'];
    $query="SELECT * FROM `account` a join register r on a.regno=r.regno WHERE r.regno='$data';";
    $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $datadb[] = $row;  
     }
     foreach ($datadb as $row) {
        $reg=$row['regno'];
      
        $name=$row['name'];
        $add=$row['address'];
        $q1=$row['q1'];
        $q2=$row['q2'];
        $q3=$row['q3'];
        $q4=$row['q4'];
        $crdrw=$row['cr_dr'];
        echo "sss$crdrw" ;
        $sy=$row['s_year'];
        $sr=$row['s_real'];
        $ob=$row['op_bln'];
        $eb=$row['en_bln'];
        $nr=$row['n_real'];
       
     }
     $rb=$ob+$nr+$crdr+$sr;

     $query="SELECT * FROM `normal_tr`WHERE regno='$reg';";
     $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $datax[] = $row;  
     }

    }else{
        
        echo"
        
        <script>
        
        // JavaScript redirect
        window.location.href = 'upn2.php';
    </script>
        ";
    }





}
$query="SELECT `run` FROM `temp2`;";
$result = $conn->query($query); 
 while($row = $result->fetch_assoc()) {
 $dataxxx[] = $row;  
 }
 foreach ($dataxxx as $row) {
    $run=$row['run'];}

   


if($run=='1'){

    echo"<style> 
    .wel{display: none;} 
    .sbln{display: block;}
    </style>";
 
    $query="UPDATE `temp2` SET `run`='0';";
mysqli_query($conn,$query);
$query="SELECT `regno` FROM `temp`;";
$result = $conn->query($query); 
$row = $result->fetch_assoc();
$reg = $row['regno'];

$query="SELECT * FROM `account` a join register r on a.regno=r.regno WHERE r.regno='$reg';";
$result = $conn->query($query); 
 while($row = $result->fetch_assoc()) {
 $dt[] = $row;  
 }
 foreach ($dt as $row) {
  
    $reg1=$row['regno'];
    $regwx=" / Reg: NO: $reg1";
    $name=$row['name'];
    $add=$row['address'];
    $q1=$row['q1'];
    $q2=$row['q2'];
    $q3=$row['q3'];
    $q4=$row['q4'];
    $crdrw=$row['cr_dr'];
    $sy=$row['s_year'];
    $sr=$row['s_real'];
    $ob=$row['op_bln'];
    $eb=$row['en_bln'];
    $nr=$row['n_real'];
    $qt1=$q1;
    $qt2=$q2;
    $qt3=$q3;
    $qt4=$q4;
 }
 $rb=$ob+$nr+$crdrw+$sr;

 $query="SELECT * FROM `normal_tr`WHERE regno='$reg1';";
 $result = $conn->query($query); 
 while($row = $result->fetch_assoc()) {
 $datax2[] = $row;  
 }}






 if (isset($_POST['search6']) ||!empty($_POST['saerch6'])) {
    $reg=$_POST['reg'];
    $reg1=" / Reg: NO: $reg";
    echo"<style> 
    .wel{display: none;} 
    .nbln{display: block;}
    </style>";

$query="SELECT * FROM `share_tr` WHERE `regno`=$reg ;";


     $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $dataxx[] = $row;  
     }

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
 

     $query="SELECT * FROM `account` WHERE regno='$reg';";
     $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data1[] = $row;  
     }
     foreach ($data1 as $row) {
        $crdr=$row['s_cr_dr'];
     }
     $todayDate = date('Y');
     $date="$todayDate-01-01";

     $query="SELECT sum(amount)  as total FROM `share_tr` WHERE regno='$reg' and date <'2023-01-01' and des='dr';";
    
     $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data2[] = $row;  
     }
     foreach ($data2 as $row) {
        $sdr=$row['total'];
     }
     $query="SELECT sum(amount)  as total FROM `share_tr` WHERE regno='$reg' and date <'2023-01-01' and des='cr';";
    
     $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data3[] = $row;  
     }
     foreach ($data3 as $row) {
        $scr=$row['total'];
     }
     $st=$sdr-$scr;
     $stbln="$st/-";
     $en=$st+$crdr;
     $enbln="$en/-";
     $blnc="$crdr/-";



    $query="SELECT * FROM `register` WHERE regno='$reg';";
    $result = $conn->query($query); 
     while($row = $result->fetch_assoc()) {
     $data4[] = $row;  
     }
     foreach ($data4 as $row) {
        $names=$row['name'];
        $adds=$row['address'];
     }
        $regs="<br> / Reg NO :$reg";

    }


    

?>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>
        
        
        
    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <div class="whiop">
                    <h3> System Services </h3>
                
                    <button class="sbtn" onclick='register()'>Registration</button><br>
                    <button class="sbtn" onclick='update()'>Info Update</button><br>
                    <button class="sbtn" onclick='dep()'>Share DEP:</button><br>
                    <button class="sbtn" onclick='withd()'>Normal DEP:</button><br>
                    <button class="sbtn" onclick='sblnc()'>Normal Account</button><br>
                    <button class="sbtn" onclick='nblnc()'>Share Account</button><br>
                    <button class="sbtn" onclick='rate()'>Rate Change</button><br>
                    <button class="sbtn" onclick='error()'>Error correction</button><br>
                </div>
                <div class="footbar">
                    <h4> Govi Jana Bank Support Tool</h4>
                    <p>___________________</p>
                    <h5> Developed By Nirosh Madushan</h5>
                    <h6> University Of <br>Sri Jayewardenepura</h6>
                    <p class="eml"> niroshmadushan.official@gmail.com</p>
                    <p>___________________</p>
                </div>
             </div>
             <div class="containeer">

                <div class="titlebar">
                    <div class="tit">
                
                        <img src="img/head.png" height="30px" width="30px"> 
                        <h2> Equity Cash Management System </h2>
                    </div>
                </div>
                <div class="titlebar2">
                    <div class="tit">
                        <img src="img/admin.png" height="30px" width="30px"> 
                        <h2> Administrator </h2>
                    </div>
                </div>
                <div class="view">
                <div class="datatable" id="dttbl">
                        <div class="src">
                            <form action="" method="post">
                                <label> Search By Name or Register No :</label>
                            <input min="0" class="srch" oninput="capitalizeInput5()" id="data" type="text"  name="reg" required/>
                                <button class="sbtn sc" value="search4" name="search4">Search</button>
                            </form>
                          
                            <script>
                                function capitalizeInput5() {
                                var inputElement = document.getElementById('data');
                                var inputValue = inputElement.value;
                                // Capitalize the input value
                                inputValue = inputValue.toUpperCase();
                                // Update the input field with the capitalized value
                                inputElement.value = inputValue;
                            
                                }
                            </script>
                        </div>
                        <div class="tbl" id="mytbl">
                            <table>
                                <tr>
                                    <th>
                                        	Reg No
                                    </th>
                                    <th class="tblname">
                                        Full Name
                                    </th>
                                    <th>
                                        Share Int
                                    </th>
                                    <th>
                                        Normal Int
                                    </th>
                                    <th>
                                        Share TRn(Y)
                                    </th>
                                    <th>
                                        Normal TRn(Y)
                                    </th>
                                    <th>
                                        Year End BLN
                                    </th>


                                </tr>
                                <?php foreach ($datax as $row) {?>
                                    <tr >
                                        <td >
                                        <?php   echo $row['regno'];?>
                                        </td>   
                                    
                                    
                                        <td>
                                        <?php   echo $row['name'];?>
                                        </td>   
                                    
                                    
                                      
                                    
                                        <td >
                                        <?php   echo $row['s_year'];?>
                                        </td>   
                                    
                                    
                                        <td>
                                        <?php
                                            $q1 = floatval($row["q1"]);
                                            $q2 = floatval($row["q2"]);
                                            $q3 = floatval($row["q3"]);
                                            $q4 = floatval($row["q4"]);
                                            $finalBalance=$q1+$q2+$q3+$q4;
                                            echo $finalBalance;
                                            
                                        ?>   
                                        </td>   
                                    
                                    
                                        <td>
                                        <?php   echo $row['s_cr_dr'];?>
                                        </td>   
                                    
                                    
                                        <td>
                                        <?php   echo $row['cr_dr'];?>
                                        </td>   
                                    
                                    
                                        <td >
                                        <?php   echo $row['en_bln'];?>
                                        </td>   
                                    </tr>
                                <?php }?>   
                                <tr>
                                
                                </tr>  
                            </table>
                           
                            <script>
                                    // Array to store row data
                                    var rowDataArray = [];

                                    // Get the table element by its ID
                                    var table = document.getElementById("mytbl");

                                    // Add a click event listener to the table rows
                                    table.addEventListener("click", function(e) {
                                        // Check if the clicked element is a table row
                                        if (e.target.tagName === "TD") {
                                        // Get the data from the clicked row
                                        var rowData = [];
                                        var cells = e.target.parentNode.cells;
                                        
                                        for (var i = 0; i < cells.length; i++) {
                                            rowData.push(cells[i].textContent.trim());
                                        }

                                        // Add the row data to the array
                                        rowDataArray.push(rowData);

                                        // Display an alert with the row data
                                        alert("REG NO: " + rowData[0]+"\n Name: " + rowData[1]+"\n Share Int: " + rowData[3]+"\n Normal Int: " + rowData[4]+"\n Share Bln: " + rowData[5]+"\n Normal Bln:" + rowData[6]+"\n Final Bln: " + rowData[7]);
                                        }
                                    });
                            </script>
                            
                        </div>
                        <div>
                            <button onclick="printDash()" style="margin-left:650px;margin-top:20px;text-align:center;" class="sbtn sc" >Print</button>
                                    
                            <script>
                                function printDash() {
                                    // Navigate to dash.php
                                    window.location.href = 'datatablereport.php';
                                    
                                    // Optionally, you can use the following line to trigger the print dialog after navigating
                                    
                                }
                            </script>
                     </div>
                    </div>
                    <div class="reg" id="rg">
                        <div class="center">
                        <p><u>New Customer Registration Form</u> </p>
                        <form action="reg.php" method="post">
                            <input type="text" value='1' name="lck" id="lk" hidden/>
                           <table>
                            <tr>
                                <td>
                                    <label>Full Name : </label>
                                </td>
                                <td>
                                    <input type="text" oninput="capitalizeInput1()"  id="fn" name="nme" pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Address : </label>
                                </td>
                                <td>
                                    <input type="text"oninput="capitalizeInput1()" id="addr" name="add" pattern="[A-Za-z,\/ ]+" title="Only letters, numbers, and spaces are allowed." required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Special Note : </label>
                                </td>
                                <td>
                                    <input type="text"  oninput="capitalizeInput1()" id="spn" name="nt" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed."/>
                                </td>
                            </tr>
                           </table>
                           <button class="sbtn sb" value="register" name="register">Submit</button>
                        </form>
                        <script>
                            function capitalizeInput1() {
                            var inputElement = document.getElementById('fn');
                            var inputElement2 = document.getElementById('addr');
                            var inputElement3 = document.getElementById('spn');
                            var inputValue = inputElement.value;
                            var inputValue2 = inputElement2.value;
                            var inputValue3 = inputElement3.value;
                            // Capitalize the input value
                            inputValue = inputValue.toUpperCase();
                            inputValue2 = inputValue2.toUpperCase();
                            inputValue3 = inputValue3.toUpperCase();
                            // Update the input field with the capitalized value
                            inputElement.value = inputValue;
                            inputElement2.value = inputValue2;
                            inputElement3.value = inputValue3;
                        
                            }
                        </script>
                        </div>
                    </div>
                    <div class="update" id="rate">
                    <div class="center">
                    <p><u> Yearly Rate Change Form</u> </p>
                    <form action="rch.php" method="post" onsubmit="return validateForm()">
                            <table>
                                <tr>
                                <td>
                                    <label> Rate Type :</label>
                                
                                </td>
                                <td>
                                    <select class="sel" id="rtp" name="opt" required>
                                        <option value="0"> -- Select Rate --</option>
                                        <option value="1"> -> Normal Rate</option>
                                        <option value="2"> -> Share Rate</option>
                                    </select>
                                </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>New Rate : </label>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Enter new rate here ...."  pattern="[0-9]+(\.[0-9]+)?" name="rt" class="int" min="0" max="100"  required><br>

                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <label>Date : </label>
                                    </td>
                                    <td>
                                    <input type="date" id="myDat" class="int" name="md" min="<?php $todayDate = date('Y'); echo"$todayDate-01-01"?>" max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" required >
                                    </td>
                                    
                                </tr>
                                
                            </table>
                            <button type="submit" class="sbtn sb" value="submit" name="submit">Submit</button>
                        </form>
                    </div></div>
               
                <div class="update" id="up">
                    <div class="center">
                    <p><u>Customer Information Update Form</u> </p>
                    <form action="dash.php" method="post">
                        <div class="srcbox">
                         
                                    <label>Register Number :</label>
                              
                                    <input min="0" class="srch" type="Number" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" name="reg" title="Only letters, numbers, and spaces are allowed." required/>
                                    <button class="sbtn sb" value="search1" name="search1" >X</button>
                        </div>

                    </form>
                    <form action="update.php" method="post" onsubmit="return sbm3();">
                       <table>
                        <tr>
                            <td>
                                <label>Reg NO : </label>
                            </td>
                            <td>
                            <input type="text" id="regnox" name="regno" value="<?php  echo $reg125; ?>" readonly/>
                            </td>
                        <tr>
                            <td>
                                <label>Full Name : </label>
                            </td>
                            <td>
                                <input type="text" id="fnu" name="fnu" oninput="capitalizeInput3()"  pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." value="<?php  echo $name1; ?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Address : </label>
                            </td>
                            <td>
                                <input type="text" id="addru" name="addru" oninput="capitalizeInput3()" tern="[A-Za-z,\/ ]+" title="Only letters, numbers, and spaces are allowed." value="<?php  echo $add1; ?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Special Note : </label>
                            </td>
                            <td>
                                <input type="text" id="spnu" name="spnu" oninput="capitalizeInput3()"  pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed." value="<?php  echo $note1; ?>" />
                            </td>
                        </tr>
                       </table>
                       <button class="sbtn sb" value="submit" name="submit">Submit</button>
                    </form>
                    <script>
                        function capitalizeInput3() {
                        var inputElement = document.getElementById('fnu');
                        var inputElement2 = document.getElementById('addru');
                        var inputElement3 = document.getElementById('spnu');
                        var inputValue = inputElement.value;
                        var inputValue2 = inputElement2.value;
                        var inputValue3 = inputElement3.value;
                        // Capitalize the input value
                        inputValue = inputValue.toUpperCase();
                        inputValue2 = inputValue2.toUpperCase();
                        inputValue3 = inputValue3.toUpperCase();
                        // Update the input field with the capitalized value
                        inputElement.value = inputValue;
                        inputElement2.value = inputValue2;
                        inputElement3.value = inputValue3;
                    
                        }
                    </script>
                    </div>
                </div>
                <div class="update" id="error">
                    <div class="center">
                    <p><u>Error Correction</u> </p>
                    <form action="dash.php" method="post" onsubmit="return optvalidate()">
                        <div class="srcbox">
                         
                                    <label>Seq: Number :</label>
                                    <input min="0" class="srch" type="Number" id="fn"  name="seq"  required/><br><br>
                                    <label>Account Type : </label>
                                    <select class="srch sel" id="sel" name="selx" required>
                                       
                                        <option value="1" > -> Share</option>
                                        <option value="2" > -> Normal</option>
                                    </select>
                                   
                                    <button class="sbtn sb" value="search7" name="search7" >X</button>
                        </div>

                    </form>

                   
                    <form action="error.php" method="post" onsubmit="return sbm4();">
                    <input type="text" name="typ" value="<?php  echo $typ; ?>" hidden/>
                       <table>
                        <tr>
                            <td>
                                <label>SEQ NO : </label>
                            </td>
                            <td>
                            <input type="text" id="seq" name="sq" value="<?php  echo $seq; ?>" readonly/>
                            </td>
                        <tr>
                            <td>
                                <label>Description : </label>
                            </td>
                            <td>
                            <input type="text" value=<?php echo $dr; ?> id="dr" hidden/>
                            <select class="sel" id="sel2" name="selxx" required>
                                        
                                        <option value="1" >-> Credit</option>
                                        <option value="2" > -> Debit</option>
                                    </select>
                                    <script>
                                // Your condition (replace this with your actual condition)
                                var condition = document.getElementById("dr").value;

                                // Get the select element
                                var selectElement = document.getElementById("sel2");

                                // If the condition is true, automatically select an option (replace "option2" with the desired value)
                                if (condition=='1') {
                                    selectElement.value = "2";
                                }else{
                                    selectElement.value = "1";
                                }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date : </label>
                            </td>
                            <td>
                            <input type="date" id="myDat" required  class="int" name="dte"  max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" value=<?php echo $dte;?>  >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Amount: </label>
                            </td>
                            <td>
                            <input type="text" required placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="amt" value=<?php echo $val; ?> ><br>
                            </td>
                        </tr>
                       </table>
                       <button class="sbtn sb" value="submit" name="submit">Submit</button>
                    </form>
                    <script>
                        function capitalizeInput3() {
                        var inputElement = document.getElementById('fnu');
                        var inputElement2 = document.getElementById('addru');
                        var inputElement3 = document.getElementById('spnu');
                        var inputValue = inputElement.value;
                        var inputValue2 = inputElement2.value;
                        var inputValue3 = inputElement3.value;
                        // Capitalize the input value
                        inputValue = inputValue.toUpperCase();
                        inputValue2 = inputValue2.toUpperCase();
                        inputValue3 = inputValue3.toUpperCase();
                        // Update the input field with the capitalized value
                        inputElement.value = inputValue;
                        inputElement2.value = inputValue2;
                        inputElement3.value = inputValue3;
                    
                        }
                    </script>
                    </div>
                </div>
            
            <div class="deposite" id="dp">
                <div class="center">
                <p><u>New Share Deposite</u> </p>
                <form action="dash.php" method="post">
                    <div class="srcbox">
                     
                                <label>Register Number :</label>
                          
                                <input min="0" class="srch" type="Number" id="fn" name="reg" required/>
                                <button class="sbtn sb" value="search2" name="search2">X</button>
                    </div>

                </form>
                <form action="sdep.php" method="post" onsubmit="return sbm();">
                   <table>
                    <tr>
                        <td>
                            <label>Reg NO : </label>
                        </td>
                        <td>
                            <input type="text" id="regno1" name="reg" value="<?php  echo $reg3; ?>" readonly/>
                        </td>
                    <tr>
                        <td>
                            <label>Full Name : </label>
                        </td>
                        <td>
                            <input type="text" value="<?php  echo $name2; ?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Set Date : </label>
                        </td>
                        <td>
                        <input type="date" id="myDat" class="int" name="md" min="<?php $todayDate = date('Y'); echo"$todayDate-01-01"?>" max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" required >
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <label>Amount : </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="amt"  required><br>

                        </td>
                        
                    </tr>
                   
                   </table>
                   <button class="sbtn sb" value="submit" name="submit">Submit</button>
                </form>
                </div>
            </div>
            <div class="withdrawal" id="wth">
                <div class="center">
                <p><u>New Normal Deposite</u> </p>
                <form action="" method="post">
                    <div class="srcbox">
                     
                                
                          
                                <label>Register Number :</label>
                          
                          <input min="0" class="srch" type="Number" id="fn" name="reg" required/>
                          <button class="sbtn sb" value="search3" name="search3">X</button>
                    </div>

                </form>
                <form action="ndep.php" method="post" onsubmit="return sbm1();">
                   <table>
                    <tr>
                        <td>
                            <label>Reg NO : </label>
                        </td>
                        <td>
                            <input type="text" id="regno2" name="reg" value="<?php  echo $regw; ?>" readonly/>
                        </td>
                    <tr>
                        <td>
                            <label>Full Name : </label>
                        </td>
                        <td>
                            <input type="text" value="<?php  echo $namew; ?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Set Date : </label>
                        </td>
                        <td>
                        <input type="date" id="myDat" class="int" name="md" min="<?php $todayDate = date('Y'); echo"$todayDate-01-01"?>" max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" required >
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <label>Amount : </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="amt"  required><br>

                        </td>
                        
                    </tr>
                   
                   </table>
                   <button class="sbtn sb" value="submit" name="submit">Submit</button>
                </form>
                </div>
            </div>
       
        <div class="sbln" id="sbl">
                        <div class="src">
                            <form action="" method="post">
                                <label>  Register No :</label>
                            <input type="text" id="data" oninput="capitalizeInput()" name="reg" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            <button class="sbtn sc" name="search5" value="serach5">Search</button>
                            </form>
                            <script>
                                function capitalizeInput() {
                                var inputElement = document.getElementById('data');
                                var inputValue = inputElement.value;
                                // Capitalize the input value
                                inputValue = inputValue.toUpperCase();
                                // Update the input field with the capitalized value
                                inputElement.value = inputValue;
                            
                                }
                            </script>
                        </div>
                        <div class="tbll">
                        <div class="tbl">
                            <table>
                                <tr>
                                    <th>
                                        Seq No
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>Date
                                    </th>
                                    <th>
                                       Amount
                                    </th>
                                   

                                </tr>
                                <?php  foreach ($datax2 as $row) { ?>
                        <tr>
                            <td>
                               <?php echo $row['seqno'];?>
                            </td>
                            <td>
                            <?php   $r=$row['des'];
                                    if($r=='cr'){
                                        echo"Credit";
                                    }else{
                                        echo"Debit";
                                    }                           
                            
                            
                            ?>
                            </td>
                            <td>
                            <?php echo $row['date'];?>
                            </td>
                            <td>
                            <?php echo $row['amount'];?>
                            </td>
                           
    
                        </tr>
                        



                        

                       <?php }?>
                                
                                
                              
                            </table>
                            
                        </div></div>
                        <div class="info">
                            <center>
                               <span class="nme"><?php echo$name; ?></span><br>
                               <span class="add"><?php echo$add; ?><?php echo"$regwx" ?></span><br/>
                              

                               <span>___________________________________<span>
                            </center>
                           
                            <div class=dt>
                               <table>
                                    <tr>
                                        <td>
                                           Open Balance :
                                        </td>
                                        <td class="val"></td>
                                        <td class="val">
                                        <?php echo"$ob" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           Transaction Balance :
                                        </td>
                                        <td class="val" ></td>
                                        <td class="val">
                                        <?php echo"$crdrw" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          
                                        </td>
                                        <td>
                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 1 : 
                                        </td>
                                        <td class="val">
                                        <?php echo $qt1; ?>
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 2 : 
                                        </td>
                                        <td class="val">
                                        <?php echo $qt2; ?>
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 3 : 
                                        </td>
                                        <td class="val">
                                        <?php echo $qt3; ?>
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 4 : 
                                        </td>
                                        <td class="val">
                                        <?php echo $qt4; ?>
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Total Normal Intrest : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                        <?php
                                            $qx1 = floatval($qt1);
                                            $qx2 = floatval($qt2);
                                            $qx3 = floatval($qt3);
                                            $qx4 = floatval($qt4);
                                            $finalBalance=$qx1+$qx2+$qx3+$qx4;
                                            echo $finalBalance;
                                            
                                        ?>   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Total share Intrest : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                        <?php echo"$sy" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Real Normal Intrest : 
                                        </td>
                                        <td class="val">
                                        <?php echo"$nr" ?>
                                        </td>
                                        <td class="val">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Real Share Intrest : 
                                        </td>
                                        <td class="val">
                                        <?php echo"$sr" ?>
                                        </td>
                                        <td class="val">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Real Balnce : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val" id="rb">
                                        <?php
                                            $qx1 = floatval($ob);
                                            $qx2 = floatval($crdrw);
                                            $qx3 = floatval($sr);
                                            $qx4 = floatval($nr);
                                            $finalBalancex=$qx1+$qx2+$qx3+$qx4;
                                            echo $finalBalancex;
                                            
                                        ?>   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Close Balnce : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                        <?php echo"$eb" ?>
                                        </td>
                                    </tr>
                               </table>
                               </div>
                            </div>
                            <div class='wid'> 
                              
                                 <form action="nbln.php" method="post" onsubmit="return wdvalidate();">
                                 <table>
                                        <input type="text" value=<?php echo $reg1; ?> name='reg'  hidden>
                                        <input type="text" value=<?php
                                            $qx1 = floatval($ob);
                                            $qx2 = floatval($crdr);
                                            $qx3 = floatval($sr);
                                            $qx4 = floatval($nr);
                                            $finalBalance=$qx1+$qx2+$qx3+$qx4;
                                            echo $finalBalance;
                                            
                                         ?> name='lbl' id="amnt" hidden>
                                            <tr>
                                                    <td>
                                                        <label>Set Date : </label>
                                                    </td>
                                                    <td>
                                                        <input type="date" id="myDat" class="int" name="wd" min="<?php $todayDate = date('Y'); echo"$todayDate-01-01"?>" max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" required >
                                                    </td>
                                            </tr>
                                            <tr>
                                                    <td>
                                                        <label>Amount : </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="amt" id="amount"  required><br>

                                                    </td>
                                    
                                            </tr>
                                </table>
                   <button class="sbtn sb" value="submit" name="submit">Submit</button>
                </form>
                                 
                                 
                            </div>
                       
                    </div>
                    <div class="nbln" id="nbl">
                        <div class="src">
                            <form action="" method="post">
                                <label>  Register No :</label>
                                <input min="0" class="srch" type="Number" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" name="reg" title="Only letters, numbers, and spaces are allowed." required/>
                                    <button class="sbtn sc" value="search6" name="search6" >Search</button>

                           
                            </form>
                            <script>
                                function capitalizeInput() {
                                var inputElement = document.getElementById('data');
                                var inputValue = inputElement.value;
                                // Capitalize the input value
                                inputValue = inputValue.toUpperCase();
                                // Update the input field with the capitalized value
                                inputElement.value = inputValue;
                            
                                }
                            </script>
                        </div>
                        <div class="tbll">
                        <div class="tbl">
                            <table>
                                <tr>
                                    <th>
                                        Reg No
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>Date
                                    </th>
                                    <th>
                                       Amount
                                    </th>
                                   

                                </tr>
                                <?php  foreach ($dataxx as $row) { ?>
                        <tr>
                            <td>
                            <?php   echo $row['seqno'];?>
                            </td>
                            <td>
                            <?php   $r=$row['des'];
                                    if($r=='cr'){
                                        echo"Credit";
                                    }else{
                                        echo"Debit";
                                    }                           
                            
                            
                            ?>
                            </td>
                            <td>
                            <?php   echo $row['date'];?>
                            </td>
                            <td>
                            <?php   $x=$row['amount'];
                                    echo"$x/-"
                            ?>
                            </td>
                        </tr>
                        <?php }?>
                                
                                
                              
                            </table>
                            
                        </div></div>
                        <div class="info">
                            <center>
                               <span class="nme"><?php echo $names; ?></span><br>
                               <span class="add"><?php echo$adds; ?><?php echo"$regs" ?></span><br/>
                               <span>___________________________________<span>
                            </center>
                           
                            <div class=dt>
                               <table>
                                    <tr>
                                        <td>
                                           Open Balance :
                                        </td>
                                        <td class="val"></td>
                                        <td class="val">
                                            <?php echo $stbln;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           Transaction Balance :
                                        </td>
                                        <td class="val" ></td>
                                        <td class="val">
                                        <?php echo $blnc;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          
                                        </td>
                                        <td>
                                       
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                         Close Balnce : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                           <?php echo $enbln;?>
                                        </td>
                                    </tr>
                               </table>
                               </div>
                            </div>
                            <div class='wid'> 
                              
                              <form action="sbln.php" method="post" onsubmit="return wdvalidate2();">
                              <table>
                                     <input type="text" value=<?php echo $reg; ?> name='reg'  hidden>
                                     <input type="text" value=<?php
                                        
                                         echo $en;
                                         
                                      ?> name='lbl' id="amnt1" hidden>
                                         <tr>
                                                 <td>
                                                     <label>Set Date : </label>
                                                 </td>
                                                 <td>
                                                     <input type="date" id="myDat" class="int" name="wd" min="<?php $todayDate = date('Y'); echo"$todayDate-01-01"?>" max="<?php $todayDate = date('Y'); echo"$todayDate-12-31"?>" required >
                                                 </td>
                                         </tr>
                                         <tr>
                                                 <td>
                                                     <label>Amount : </label>
                                                 </td>
                                                 <td>
                                                     <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="amt" id="amount1"  required><br>

                                                 </td>
                                 
                                         </tr>
                             </table>
                <button class="sbtn sb" value="submit" name="submit">Submit</button>
             </form>
                              
                              
                         </div>
                       
                    </div>

                    <div class='analys' id='anls'>
                        
                        <h3><u>Data Analaysis Report</u></h3>
                        <h4> <?php echo  $updateyear;?> </h4>
                        <p>_____________________________________________________________________________________</p>
                        <div class="tab">
                            <table>
                                <tr>
                                    <th>
                                       No of total Customers: 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $regcus?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal Dep: In this year : 
                                    </th>
                                    <td><?php echo $normaldeposite?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal With: In this year : 
                                    </th>
                                    <td><?php echo $normalwithdrawal?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $normalbalance?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal open-balance this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $openbalance?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal balance : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $normalastbalance?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share Dep: In this year : 
                                    </th>
                                    <td><?php echo $sharedeposite?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share With: In this year : 
                                    </th>
                                    <td><?php echo $sharewithdrawal?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $sharebalance?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share open-balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $totalopensharebalnce?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share balance  : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $totalsharebalance?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal + share balnce : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $totalnormalshare?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Share Int: In this year : 
                                    </th>
                                    <td><?php echo $totalshareint?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal Int: In this year : 
                                    </th>
                                    <td><?php echo $totalnormalint?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $totalint?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest + Normal Blance : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $totalasttblnc; ?></td>
                                </tr>
                               
                                
                            </table>

                            <div>
                                <form action="rp.php" method="post">
                                    <input type='text' name="d1" value="<?php echo $regcus; ?>" hidden/>
                                    <input type='text' name="d2" value="<?php echo $normaldeposite; ?>" hidden/>
                                    <input type='text' name="d3" value="<?php echo $normalwithdrawal; ?>" hidden/>
                                    <input type='text' name="d4" value="<?php echo $normalbalance; ?>" hidden/>
                                    <input type='text' name="d5" value="<?php echo $openbalance; ?>" hidden/>
                                    <input type='text' name="d6" value="<?php echo $normalastbalance; ?>" hidden/>
                                    <input type='text' name="d7" value="<?php echo $sharedeposite; ?>" hidden/>
                                    <input type='text' name="d8" value="<?php echo $sharewithdrawal; ?>" hidden/>
                                    <input type='text' name="d9" value="<?php echo $sharebalance; ?>" hidden/>
                                    <input type='text' name="d10" value="<?php echo $totalopensharebalnce; ?>" hidden/>
                                    <input type='text' name="d11" value="<?php echo $totalsharebalance; ?>" hidden/>
                                    <input type='text' name="d12" value="<?php echo $totalnormalshare; ?>" hidden/>
                                    <input type='text' name="d13" value="<?php echo $totalshareint; ?>" hidden/>
                                    <input type='text' name="d14" value="<?php echo $totalnormalint; ?>" hidden/>
                                    <input type='text' name="d15" value="<?php echo $totalint; ?>" hidden/>
                                    <input type='text' name="d16" value="<?php echo $totalasttblnc; ?>" hidden/>
                                    <button type="submit" style="margin-left:610px;margin-top:20px;text-align:center;" value="submit" name="submit" class="sbtn sc" >Print</button>
                                </form>
                                  
                    </div>
                        </div>
                    </div>
                    <div class='wel' id='wl'>
                        <center>
                        <h1>Welcome to ..</h1>
                        <h3>Govi Jana Bank</h3>
                        <h4>Equity Cash Management System</h4>
                        <img src="img/pc.png" height="150px" width="150px"> 
                            </center>
                    </div>


                </div>

                            
            </div>
            <div class="infobar">
                <div class="wiop">
                    <h3> System Data Service </h3>
                    
                    <button class="sbtn" onclick="viewtbl();">Customer TBL</button><br>
                    <button class="sbtn"  onclick="analys();">Data Analaysis</button><br>
                    <a href="http://localhost/sqlbackup/"><button class="sbtn">DB Backup</button><br></a>
                    <a href="http://localhost/phpmyadmin"><button class="sbtn">DB Login</button><br></a>
                    <button class="sbtn" onclick="home();">Home</button><br>
                    <button class="sbtn" onclick="runupdate();">Year End balancing</button><br>
                    
                </div>
                <div class="wiop2">
                    <h3> System Data Service </h3>
                    <p>Share  : <span class="rate" id ='srt'><?php echo $srt?>%</span></p>
                    <p>Normal : <span class="rate" id ='srt'><?php echo $nrt?>%</span></p>
                    <p><span class="rate" id ='srt'> <?php echo  date("Y-m-d");?></span></p>
                </div>  
                <div class="wiop3">
                <a href="logout.php"><button class="sbtn sc" value="search" name="search">Log Out</button><br></a>
 
                </div>  
            </div>


           
           
        </div>
       
       

    </body>
</html>