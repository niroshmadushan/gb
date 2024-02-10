<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();


}
$conn = mysqli_connect("localhost","root","","gbdb"); 

$query="SELECT * FROM `account`a join register r on a.regno=r.regno order by r.regno asc;"; 
$result = $conn->query($query); 

     while($row = $result->fetch_assoc()) { 
         $datax[] = $row;  
     }

?>
<htmlL>
    <head>
        <title>
            
        </title>
        <style>
            table th{
                background-color: rgb(202, 198, 198);
                color: rgb(0, 0, 0);
                border-radius: 10px;
                font-family: sans-serif;
                font-size: 15px;
                
            }
            .name{
                width: 330px;
               
            }
            .val{
                width: 100px;
            }
            table th{
                text-align: center;
            }
            table td{
                text-align: center;
            }
            
        </style>
    </head>
    <body>
    <script>
// Automatically trigger print when the page loads
window.onload = function() {
    window.print();
};
</script>
        <CENTER>
          
            <hr/>
            <table>
                <tr>
                    <th class="val">
                        Req No
                    </th>
                    <th class="name">
                        Full Name
                    </th>
                    <th class="val">
                        Share INT
                    </th>
                    <th class="val">
                        Normal INT
                    </th>
                    
                    <th class="val">
                        Share TRn(y)
                    </th>
                    <th class="val">
                        Normal TRn(y)
                    </th>
                    <th class="val">
                        Year End BLNC
                    </th>
                </tr>
                
                                <?php $round=1;
                                foreach ($datax as $row) {?>
                                    

                                    <?php if($round==30){
                                        $round=0;?>
                                         
                                        <tr>
                                        
                                        <th class="val">
                                            Req No
                                        </th>
                                        <th class="name">
                                            Full Name
                                        </th>
                                        <th class="val">
                                            Share INT
                                        </th>
                                        <th class="val">
                                            Normal INT
                                        </th>
                                        
                                        <th class="val">
                                            Share TRn(y)
                                        </th>
                                        <th class="val">
                                            Normal TRn(y)
                                        </th>
                                        <th class="val">
                                            Year End BLNC
                                        </th>
                                    </tr>
                                    <?php }?>




                                    <tr >
                                        <td >
                                        <?php
                                            $round=$round+1;
                                        echo $row['regno'];?>
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
            </table>
        </CENTER>
       
    </body>
</htmlL>