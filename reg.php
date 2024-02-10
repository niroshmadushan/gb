<?php

if (isset($_POST['register']) ||!empty($_POST['register'])) {
    echo"<script>alert('test);</script>'";
        $name=$_POST['nme'];
        $add=$_POST['add'];
        $note=$_POST['nt'];
        $lock=$_POST['lck'];
      

    if($lock=='1'){
        
        $conn = mysqli_connect("localhost","root","","gbdb"); 
        $query="INSERT INTO `register`(`name`, `address`, `note`) VALUES ('$name','$add','$note')";
    
       
    
        if ($conn->query($query) === TRUE) {
            
    
    
    
    
            $query="SELECT `regno` FROM `register`ORDER BY regno DESC LIMIT 1;"; 
            $result = $conn->query($query); 
            
                 while($row = $result->fetch_assoc()) { 
                     $data[] = $row;  
                 }
                 foreach ($data as $row) {
                 $reg=$row['regno'];
                 }
    
                 $query2="INSERT INTO `account`(`regno`, `op_bln`, `q1`, `q2`, `q3`, `q4`, `cr_dr`, `s_year`, `s_real`, `en_bln`, `n_real`) VALUES ('$reg','0','0','0','0','0','0','0','0','0','0')";
    
            if ($conn->query($query2) === TRUE) {
           
           
    
        // Add a delay of 3 seconds using JavaScript and then redirect
        echo "
      

        <style>
        .msgbox{display: none;}
        .msgbox2{display: block;}
        
        </style>
        <script> window.location.href = 'trnsuc.php';</script>
       
        ";
           
        } else {
            echo "<p class='err'>Error: " . $query . "<br>" . $conn->error."</p>";
         
        }
    }}
        // Close the connection
        $conn->close();
        
    }
    


?>