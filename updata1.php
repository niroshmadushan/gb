
<?php
session_start();

// Check if the user is not logged in
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
$backupFile = "C:\\xampp\\htdocs\\pro\\sqlbackup\\{$currentDateTime}.sql";

// Command to create a full backup of the gbdb database
$command = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$backupFile}";

// Execute the command
exec($command);















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

     }else{


        if($year>$td){

            
        $query="SELECT`regno`,`en_bln` FROM `account`;";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) { 
            $data46[] = $row;  
        } 
        foreach ($data46 as $row) {
            $enb=floatval($row['en_bln']);  
            $reg=floatval($row['regno']);   
            
            $query="UPDATE `account` SET `op_bln`='$enb' WHERE regno='$reg';";
           mysqli_query($conn,$query);
           $query="UPDATE `update_tbl` SET `year`='$year' WHERE id='1';";
           mysqli_query($conn,$query);
           $query="UPDATE `temp2` SET `run`='0' WHERE 1";
           mysqli_query($conn,$query);
         }

        }else{
            echo"
            <script>
            alert('Please, Check Your Date is correct or not?');
            window.location.href = 'trnsuc.php';
            </script>
            ";
        }
     }


        echo"
        <script>
        // JavaScript redirect
        window.location.href = 'trnsuc.php';
    </script>
        ";
    
    ?>