<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        


    <title>Settings</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-X  0.5s;
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
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
        header("location: ../login.php");
    }

}else{
    header("location: ../login.php");
}



//import database
include("../connection.php");


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
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
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
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn  ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn ">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn ">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn   ">
                        <a href="patient.php" class="non-style-link-menu  "><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn  ">
                        <a href="Reviews and feedback.php" class="non-style-link-menu  "><div><p class="menu-text">Reviews</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn   menu-active ">
                        <a href="query.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Report</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    


                </tr>
                <tr>
                <td>
                    <center>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Query</p>
                        </center>                     
                </td>
                </tr>
                    
                </tr>
         
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                   Doctor Name
                                    
                                </th>
                                
                                
                                <th class="table-headin">
                                    
                                    Query
                                    
                                </th>
                                    
                        </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query("select * from query;");

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $did=$row["docid"];
                                    
                                    $reviews=$row["qury"];
                                    $spcil_res= $database->query("select docname from doctor where docid='$did';");
                                    $spcil_array= $spcil_res->fetch_assoc();
                                    $spcil_name=$spcil_array["docname"];
                                    echo '<tr>
                                        
                                        <td > 
                                        <center>'.
                                        
                                        substr($spcil_name,0,30)
                                        .'</center></td>
                                        
                                       
                                        <td >
                                        <center>
                                            '.$reviews.'
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
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='add-review'){
        echo'
        
            <div id="popup1" class="overlay">
            <div class="popup">
            <center>
                <a class="close" href="review.php">&times;</a> 
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
                                    
    
                                    $list11 = $database->query("select  * from prescription order by pid asc;");
    
                                    for ($y=0;$y<$list11->num_rows;$y++){
                                        $row00=$list11->fetch_assoc();
                                         
                                        $id00=$row00["pid"];
                                        echo "<option value=".$id00.">$id00</option><br/>";
                                    };
    
    
    
                                    
                    echo     '       </select><br><br>
                            </td>
                        </tr>
                        <tr>
                                <td >
                                    <div style="display:flex;justify-content: center;">
                                    <input type="submit" value="Save" class="login-btn btn-primary btn" name="shedulesubmit">
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
        }
    };
    ?>