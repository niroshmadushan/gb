<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();


}
echo"<style> 
.update{display: none;}
.reg{display: none;} 
.deposite{display: none;}
.withdrawal{display: none;}
.datatable{display: none;}
.sbln{display: none;}
.nbln{display: none;}
</style>";






    

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
                    <button class="sbtn">Btn name</button><br>
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
                            <input type="text" id="data" oninput="capitalizeInput()"  pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            <button class="sbtn sc">Search</button>
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
                        <div class="tbl">
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
                                <tr>
                                    <td>
                                        01
                                    </td>
                                    <td>
                                        test
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        100
                                    </td>

            
                                </tr>
                              
                            </table>
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
                                    <input type="text"oninput="capitalizeInput1()" id="addr" name="add" pattern="[A-Za-z ]+" title="Only letters, numbers, and spaces are allowed." required/>
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
               
                <div class="update" id="up">
                    <div class="center">
                    <p><u>Customer Information Update Form</u> </p>
                    <form action="" method="post">
                        <div class="srcbox">
                         
                                    <label>Register Number :</label>
                              
                                    <input min="0" class="srch" type="Number" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                                    <button class="sbtn sb" value="search" name="search">X</button>
                        </div>

                    </form>
                    <form action="" method="post" onsubmit="return sbm();">
                       <table>
                        <tr>
                            <td>
                                <label>Reg NO : </label>
                            </td>
                            <td>
                                <input type="text" id="regno" hidden/>
                            </td>
                        <tr>
                            <td>
                                <label>Full Name : </label>
                            </td>
                            <td>
                                <input type="text" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Address : </label>
                            </td>
                            <td>
                                <input type="text" id="addr" oninput="capitalizeInput()"  pattern="[A-Za-z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Special Note : </label>
                            </td>
                            <td>
                                <input type="text" id="spn" oninput="capitalizeInput()"  pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed."/>
                            </td>
                        </tr>
                       </table>
                       <button class="sbtn sb" value="submit" name="submit" onclick="upd();">Submit</button>
                    </form>
                    <script>
                        function capitalizeInput() {
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
            
            <div class="deposite" id="dp">
                <div class="center">
                <p><u>New Share Deposite</u> </p>
                <form action="" method="post">
                    <div class="srcbox">
                     
                                <label>Register Number :</label>
                          
                                <input min="0" class="srch" type="Number" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                                <button class="sbtn sb" value="search" name="search">X</button>
                    </div>

                </form>
                <form action="" method="post" onsubmit="return sbm();">
                   <table>
                    <tr>
                        <td>
                            <label>Reg NO : </label>
                        </td>
                        <td>
                            <input type="text" id="regno" hidden/>
                        </td>
                    <tr>
                        <td>
                            <label>Full Name : </label>
                        </td>
                        <td>
                            <input type="text" hidden/>
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
                            <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="rt"  required><br>

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
                          
                                <input min="0" class="srch" type="Number" id="fn" oninput="capitalizeInput()"  pattern="[A-Z ]+" title="Only letters, numbers, and spaces are allowed." required/>
                                <button class="sbtn sb" value="search" name="search">X</button>
                    </div>

                </form>
                <form action="" method="post" onsubmit="return sbm();">
                   <table>
                    <tr>
                        <td>
                            <label>Reg NO : </label>
                        </td>
                        <td>
                            <input type="text" id="regno" hidden/>
                        </td>
                    <tr>
                        <td>
                            <label>Full Name : </label>
                        </td>
                        <td>
                            <input type="text" hidden/>
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
                            <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="rt"  required><br>

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
                            <input type="text" id="data" oninput="capitalizeInput()"  pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            <button class="sbtn sc">Search</button>
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
                                <tr>
                                    <td>
                                        01
                                    </td>
                                    <td>
                                        credit
                                    </td>
                                    <td>
                                        2023-12-29
                                    </td>
                                    <td>
                                        1000.00
                                    </td>
                                    
                                </tr>
                                
                                
                              
                            </table>
                            
                        </div></div>
                        <div class="info">
                            <center>
                               <span class="nme">K M KAMALAWATHI</span><br>
                               <span class="add">B 102 , VILLAGE AMPARA</span>
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
                                            1000.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           Transaction Balance :
                                        </td>
                                        <td class="val" ></td>
                                        <td class="val">
                                            1000.00
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
                                        5.00
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 2 : 
                                        </td>
                                        <td class="val">
                                        5.00
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 3 : 
                                        </td>
                                        <td class="val">
                                        5.00
                                        </td>
                                        <td class="val"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Quter 4 : 
                                        </td>
                                        <td class="val">
                                        5.00
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
                                            25.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Total share Intrest : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                            25.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Real Normal Intrest : 
                                        </td>
                                        <td class="val">
                                        20.00
                                        </td>
                                        <td class="val">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Real Share Intrest : 
                                        </td>
                                        <td class="val">
                                        20.00
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
                                        <td class="val">
                                            1040.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         Close Balnce : 
                                        </td>
                                        <td class="val">
                                      
                                        </td>
                                        <td class="val">
                                            1045.00
                                        </td>
                                    </tr>
                               </table>
                               </div>
                            </div>
                            <div class='wid'>
                                <form action='' method='post'>
                                    <table>
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
                                                        <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="rt"  required><br>

                                                    </td>
                                    
                                            </tr>
                                    </table>
                                    <button value="submit" name='submit' class='sbtn'>Withdrawal</button>
                                 </form>
                            </div>
                       
                    </div>
                    <div class="nbln" id="nbl">
                        <div class="src">
                            <form action="" method="post">
                                <label>  Register No :</label>
                            <input type="text" id="data" oninput="capitalizeInput()"  pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed." required/>
                            <button class="sbtn sc">Search</button>
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
                                <tr>
                                    <td>
                                        01
                                    </td>
                                    <td>
                                        credit
                                    </td>
                                    <td>
                                        2023-12-29
                                    </td>
                                    <td>
                                        1000.00
                                    </td>
                                    
                                </tr>
                                
                                
                              
                            </table>
                            
                        </div></div>
                        <div class="info">
                            <center>
                               <span class="nme">K M KAMALAWATHI</span><br>
                               <span class="add">B 102 , VILLAGE AMPARA</span>
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
                                            1000.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           Transaction Balance :
                                        </td>
                                        <td class="val" ></td>
                                        <td class="val">
                                            1000.00
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
                                            1045.00
                                        </td>
                                    </tr>
                               </table>
                               </div>
                            </div>
                            <div class='wid'>
                                <form action='' method='post'>
                                    <table>
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
                                                        <input type="text" placeholder="Enter Amount here ...."  pattern="[0-9]+(\.[0-9]+)?" name="rt"  required><br>

                                                    </td>
                                    
                                            </tr>
                                    </table>
                                    <button value="submit" name='submit' class='sbtn'>Withdrawal</button>
                                 </form>
                            </div>
                       
                    </div>

                    <div class='analys' id='anls'>
                        <h3><u>Data Analaysis Report</u></h3>
                        <h4> 2023 </h4>
                        <p>_____________________________________________________________________________________</p>
                        <div class="tab">
                            <table>
                                <tr>
                                    <th>
                                       No of opening Customers: 
                                    </th>
                                    <td></td>
                                    <td>3911</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                       No of New Customers: 
                                    </th>
                                    <td></td>
                                    <td>5</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                       No of Closing Customers: 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td>3916</td>
                                </tr>
                                <tr>
                                    <th>
                                      
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Deposites In this year : 
                                    </th>
                                    <td>20000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total withdrawal In this year : 
                                    </th>
                                    <td>10000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Balance In this year : 
                                    </th>
                                    <td></td>
                                    <td>10000</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Share Int: In this year : 
                                    </th>
                                    <td>1000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total Normal Int: In this year : 
                                    </th>
                                    <td>1000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest In this year : 
                                    </th>
                                    <td></td>
                                    <td>2000</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>
                                      Total intrest + Blance : 
                                    </th>
                                    <td></td>
                                    <td></td>
                                    <td>12000</td>
                                </tr>
                                
                            </table>
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
                    <button class="sbtn">DB Backup</button><br>
                    <button class="sbtn">DB Login</button><br>
                    <button class="sbtn" onclick="home();">Home</button><br>
                </div>
                <div class="wiop2">
                    <h3> System Data Service </h3>
                    <p>Share  : <span class="rate" id ='srt'> 5.0%</span></p>
                    <p>Normal : <span class="rate" id ='srt'> 3.0%</span></p>
                    <p><span class="rate" id ='srt'> 2023 - 12 - 29</span></p>
                </div>  
                <div class="wiop3">
                <a href="logout.php"><button class="sbtn" value="search" name="search">Log Out</button><br></a>
 
                </div>  
            </div>


          
           
        </div>
        <div class="msg" id="ms">
            <div class="msgbox2" id="mgbox1">
                <h3> Message Box </h3>
                <p> Transaction SuccessFully</p>
                <a href="dash.php"> <button class="sbtn ok">OK</button></a>
            </div>
        </div>
       

    </body>
</html>