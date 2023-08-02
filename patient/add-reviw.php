<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
    
    if($_POST){
        //import database
        include("../connection.php");
        
        $cid=$_POST["cid"];
        $pres=$_POST["presc"];
        $sql="insert into reviews (pid,cid,reviews) values($userid,$cid,'$pres');";
        $result= $database->query($sql);
        header("location: review.php");
        
    }


?>