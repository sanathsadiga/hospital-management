<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Patients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
<?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["docid"];
    $username=$userfetch["docname"];


    //echo $userid;
    //echo $username;
    ?>
    <div class="container">
    <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn ">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn ">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn ">
                        <a href="patient.php" class="non-style-link-menu  "><div><p class="menu-text">My Patients</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn  menu-active ">
                        <a href="prescription.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Prescription</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn ">
                        <a href="review.php" class="non-style-link-menu "><div><p class="menu-text">Report</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <?php       

                    $selecttype="My";
                    $current="My patients Only";
                    if($_POST){

                        if(isset($_POST["search"])){
                            $keyword=$_POST["search12"];
                            
                            $sqlmain= "select * from prescription where pid='$keyword';";
                            
                        }
                        
                        else{
                        $sqlmain= "select * from prescription;";
                        $selecttype="My";
                        }
                    }



                ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    
                    <td>
                        
                        <form  method="post" class="header-search">

                            <input type="search" name="search12" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;
                            
                            
                            
                       
                            <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                
          
                            </table>

                        </center>
                    </td>
                    
                </tr>
                <?php
                    
                     echo '
                     <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                     <tr>
                                <center>
                                    <td width="13%">
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=addprescription&id" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Add Prescription</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=deleteprescription&id" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete Prescription</font></button></a>
                                        </div>
                                    </td>
                            </center>
                            </tr>
                    </table>
                    ';
                ?>
                  
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Patient Id
                                
                                </th>
                             
                                <th class="table-headin">
                                
                            
                                Prescription Id
                                
                                </th>
                                <th class="table-headin">
                                  prescription
                                </th>
                                
                                
                                
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query('select * from prescription');
                                
                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $pid=$row["pid"];
                                    $id=$row["id"];
                                    $pres=$row["prescription"];
                                    
                                    echo '<tr>
                                        <td> 
                                        <center>'.
                                        substr($pid,0,35)
                                        .'
                                        </center></td>
                                       
                                        <td>
                                        <center>
                                            '.substr($id,0,10).'
                                            </center>
                                        </td>
                                        <td>
                                        <center>
                                        '.substr($pres,0,255).'
                                        </center>
                                         </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    

<?php 
   
    if($_GET){
        
        $pid=$_GET["pid"];
        $action=$_GET["action"];
        if($action =="addprescription"){

            $sqlmain= "select * from patient where pid='$id'";
            $result= $database->query($sqlmain);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="prescription.php">&times;</a>
                        <div class="content"> 
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add Presciption.</p><br><br>
                                </td>
                            </tr>
                            <tr> 
                                <td class="label-td" colspan="2">
                                <form action="add-pres.php" method="POST" class="add-new-form">
                                    <label for="name" class="form-label">Enter Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <select name="pid" id="" class="box" >
                                <option value="" disabled selected hidden>Choose patient ID</option><br/>';
                                    
    
                                    $list11 = $database->query("select  * from  patient order by pid asc;");
    
                                    for ($y=0;$y<$list11->num_rows;$y++){
                                        $row00=$list11->fetch_assoc();
                                        $sn=$row00["pname"]; 
                                        $id00=$row00["pid"];
                                        echo "<option value=".$id00.">$sn</option><br/>";
                                    };
    
    
    
                                    
                    echo     '       </select><br><br>
                            </td>
                        </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <label for="Add" class="form-label">Add Prescription: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <textarea rows="20" name="presc" cols="60" style="display: justify-content: center; resize: none;"> </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div style="display:flex;justify-content: center;">
                                    <input type="submit" value="Submit" class="login-btn btn-primary btn" name="shedulesubmit">
                                    </div>
                                </td>
                            </tr>
                            </form>
                            </table>
                            </div>
                            </center>
                    </div>
                    </div>
                        ';
        }elseif($action=="deleteprescription"){
            $pid=$_POST["pid"];
            $action=$_GET["action"];
            echo '
            <div id="popup1" class="overlay">
            <div class="popup">
            <center>
                <a class="close" href="prescription.php">&times;</a> 
                <div class="content"> 
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Delete Presciption.</p><br><br>
                                </td>
                            </tr>
                            <tr> 
                                <td class="label-td" colspan="2">
                                <form action="del-pres.php" method="POST" class="add-new-form">
                                    <label for="name" class="form-label">Enter Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <select name="pid" id="" class="box" >
                                <option value="" disabled selected hidden>Choose patient ID</option><br/>';
                                    
    
                                    $list11 = $database->query("select  * from patient order by pid asc;");
    
                                    for ($y=0;$y<$list11->num_rows;$y++){
                                        $row00=$list11->fetch_assoc();
                                        $sn=$row00["pname"];
                                        $id00=$row00["pid"];
                                        echo "<option value=".$id00.">$sn</option><br/>";
                                    };
    
    
    
                                    
                    echo     '       </select><br><br>
                            </td>
                        </tr>
                        <tr>
                                <td >
                                    <div style="display:flex;justify-content: center;">
                                    <input type="submit" value="Delete" class="login-btn btn-primary btn" name="shedulesubmit">
                                    </div>
                                </td>
                            </tr>
                            </form>
                            </table>
                            </div>
                            </center>
                    </div>
                    </div>
            ';
         }elseif($action=="delete"){
            $pid=$_GET["pid"];
            $action=$_GET["action"];
            $sql= $database->query("delete from prescription where pid='$pid';");
         }


    };

?>


</div>

</body>
</html>