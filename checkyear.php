<?php 
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
    
}
$tt=null;
$conn = mysqli_connect("localhost","root","","gbdb"); 

$query="SELECT COUNT(`regno`) as total FROM `register`;";
$result = $conn->query($query); 

     while($row = $result->fetch_assoc()) { 
         $data45[] = $row;  
     }
     foreach ($data45 as $row) {
        $tt=floatval($row['total']);       
     }
$todayDate = date('Y');
$year = intval($todayDate);
$query="SELECT `year` FROM `update_tbl`;";
$result = $conn->query($query); 

     while($row = $result->fetch_assoc()) { 
         $data47[] = $row;  
     }
     foreach ($data47 as $row) {
        $td=floatval($row['year']);       
     }

     if($year==$td){
        echo"
            <script>
            
           window.location.href = 'dash.php';
            </script>
            ";

     }else{


        if($year>$td){
            echo"
            <script>
           
            window.location.href = 'start.php';
            </script>
            ";
            
       

        }else{
            echo"
            <script>
            alert('Please, Check Your Date is correct or not?');
            window.location.href = 'index.php';
            </script>
            ";
        }
     }


        echo"
        <script>
        // JavaScript redirect
        window.location.href = 'index.php';
    </script>
        ";
    
    ?>