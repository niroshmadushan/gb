<?php
$conn = mysqli_connect("localhost","root","","gbdb"); 
$queryx="SELECT `year` FROM `update_tbl`;";
$resultx = $conn->query($queryx); 
while($rowx = $resultx->fetch_assoc()) { 
$dataancx[] = $rowx;  
}
foreach ($dataancx as $rowx) {
$updateyear =($rowx['year']);}

$d1=$_POST['d1'];
$d2=$_POST['d2'];
$d3=$_POST['d3'];
$d4=$_POST['d4'];
$d5=$_POST['d5'];
$d6=$_POST['d6'];
$d7=$_POST['d7'];
$d8=$_POST['d8'];
$d9=$_POST['d9'];
$d10=$_POST['d10'];
$d11=$_POST['d11'];
$d12=$_POST['d12'];
$d13=$_POST['d13'];
$d14=$_POST['d14'];
$d15=$_POST['d15'];
$d16=$_POST['d16'];





?>
<html>
    <head>
        <style>
            table th{
                text-align:right;
                padding-right:10px;
                font-size: 18px;
            }
            table td{
                width:100px;
                font-size: 18px;
                text-align:center;
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
    <div class='analys' id='anls'>
                        <center>
                            <h2>Data Analaysis Report</h2>
                            <h3>
                                <?php echo  $updateyear;?></h3>
                           <hr/>
                        
                            <div class="tab">
                            <table border="1px">
                                <tr>
                                    <th>
                                       No of total Customers: 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $d1?></td>
                                    
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal Dep: In this year : 
                                    </th>
                                    <td><?php echo $d2?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal With: In this year : 
                                    </th>
                                    <td><?php echo $d3?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $d4?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal open-balance this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $d5?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal balance : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $d6?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share Dep: In this year : 
                                    </th>
                                    <td><?php echo $d7?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share With: In this year : 
                                    </th>
                                    <td><?php echo $d8?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $d9?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share open-balance In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $d10?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total share balance  : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $d11?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal + share balnce : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $d12?></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Share Int: In this year : 
                                    </th>
                                    <td><?php echo $d13?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal Int: In this year : 
                                    </th>
                                    <td><?php echo $d14?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest In this year : 
                                    </th>
                                    <td></td>
                                    <td><?php echo $d15?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest + Normal Blance : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $d16; ?></td>
                                </tr>
                               
                                
                            </table>

    </body>


</html>
    