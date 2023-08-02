<?php

session_start();

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
        header("location: ../login.php");
    }else{ 
    $useremail=$_SESSION["user"];}

}else{
    header("location: ../login.php");
}
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $pid=$_POST["pid"];
        $result001= $database->query("select * from prescription where pid=$pid;");
        $id=($result001->fetch_assoc())["pid"];
         $database->query("delete from prescription where pid='$id';");
        
        //print_r($email);
        header("location: prescription.php");
    }else{
        echo'<script>alert("Not found")</script>;';
    }


?>