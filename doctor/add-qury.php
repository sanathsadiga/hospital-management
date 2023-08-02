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
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["docid"];
    $username=$userfetch["docname"];
    
    if($_POST){
        //import database
        include("../connection.php");
        
        
        $qry=$_POST["qury"];
        $sql="insert into query (docid,qury) values($userid,'$qry');";
        $result= $database->query($sql);
        header("location: review.php");
        
    }


?>