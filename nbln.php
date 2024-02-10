

<?php

$conn = mysqli_connect("localhost","root","","gbdb"); 

if (isset($_POST['submit']) ||!empty($_POST['submit'])) {
    
    $todayDate = $_POST['wd'];
    $reg=$_POST['reg'];
    $amtlbl=$_POST['lbl'];
    $amtt=$_POST['amt'];

    $data1 = floatval($amtt);
    $data2 = floatval($amtlbl);
    echo"$todayDate,$reg,$amtt";
    
  
    $query="INSERT INTO `normal_tr`(`des`, `date`, `amount`, `regno`) VALUES ('cr','$todayDate','$amtt','$reg')";
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



}









?>


