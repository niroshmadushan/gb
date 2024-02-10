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

    $reg=$_POST['reg'];
    $date=$_POST['md'];
    $amt=$_POST['amt'];
    $dat="$date";

    
    if($date=''){echo"<script>alert('Please Eneter Date...');</script>";}

    $query="INSERT INTO `normal_tr`(`des`, `date`, `amount`, `regno`) VALUES ('dr','$dat','$amt','$reg')";

    if ($conn->query($query) === TRUE) {

        $query="DELETE FROM `temp`;";
        mysqli_query($conn,$query);
        $query="INSERT INTO `temp`(`regno`) VALUES ('$reg')";

        if ($conn->query($query) === TRUE) {

            echo "
      

            <style>
            .msgbox{display: none;}
            .msgbox2{display: block;}
            
            </style>
            <script> window.location.href = 'trnsuc.php';</script>
           
            ";
    
        }
    
    
    } else {
        echo "<p class='err'>Error: " . $query . "<br>" . $conn->error."</p>";
     
    }

}

?>

