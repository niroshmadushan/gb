<?php
 $conn = mysqli_connect("localhost","root","","gbdb"); 
if (isset($_POST['submit']) ||!empty($_POST['submit'])) {
    echo"<script>alert('test);</script>'";
        $seq=$_POST['sq'];
        $opt=$_POST['selxx'];
        $typ=$_POST['typ'];
        $date=$_POST['dte'];
        $dat="$date";
        $amnt=$_POST['amt'];
      

    
        



        if($typ=='1'){

            if($opt=='1'){

                $query="UPDATE `share_tr` SET `des`='cr',`date`='$dat',`amount`='$amnt' WHERE seqno='$seq';";
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
                $query="UPDATE `share_tr` SET `des`='dr',`date`='$dat',`amount`='$amnt' WHERE seqno='$seq';";
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



        }else{

            if($opt=='1'){

                $query="UPDATE `normal_tr` SET `des`='cr',`date`='$dat',`amount`='$amnt' WHERE seqno='$seq';";
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
                $query="UPDATE `normal_tr` SET `des`='dr',`date`='$dat',`amount`='$amnt' WHERE seqno='$seq';";
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

        }





       
    }
        // Close the connection
        $conn->close();
        
    
    


?>