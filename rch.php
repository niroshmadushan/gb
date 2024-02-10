<?php

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
    
}
$conn = mysqli_connect("localhost","root","","gbdb"); 
if (isset($_POST['submit']) ||!empty($_POST['submit'])) {
    $opt=$_POST['opt'];
    $data=$_POST['md'];
    $rate=$_POST['rt'];
    $dat="$data";
  
    if($opt=='1'){//normal
       $query="INSERT INTO `n_rate`(`date`, `rate`) VALUES ('$dat','$rate');";

       if ($conn->query($query) === TRUE) {

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




    }else{
        if($opt=='2'){//share



            $query="INSERT INTO `s_rate`(`date`, `rate`) VALUES ('$data','$rate');";
            if ($conn->query($query) === TRUE) {

                echo "
      

        <style>
        .msgbox{display: none;}
        .msgbox2{display: block;}
        
        </style>
        <script> window.location.href = 'trnsuc.php';</script>
       
        ";
            } else {
                echo "<p class='err'>Error:   Data Submit Error <br>" . $conn->error."</p>";
             
            }
            
        }
    }
   
}

?>
