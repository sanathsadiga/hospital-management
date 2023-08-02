<?php

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
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $pid=$_POST["pid"];
        $pres=$_POST["presc"];
        $sql="insert into prescription (pid,prescription) values($pid,'$pres');";
        $result= $database->query($sql);
        header("location: prescription.php");
        
    }


?>