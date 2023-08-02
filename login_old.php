<?php
@include 'connection.php';


if(isset($_POST['signup'])){
    $user = $_POST['user'];
    $email=$_POST['email'];
    $pass = $_POST['pass'];
    $cpass=$_POST['cpass'];
    if(empty($user) || empty($email) || empty($pass) || empty($cpass)){
        $message[] = 'please fill out all';
    } 
    $user_check_query = "SELECT * FROM users WHERE name='$user' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $usern = mysqli_fetch_assoc($result);
    if ($usern) { // if user exists
        if ($usern['name'] === $user) {
            $message[]="Username already exists";
        }
    
        if ($usern['email'] === $email) {
            $message[]="email already exists";
        }
    }else{
       
        if($pass != $cpass){
            $message[]='password doesnot match';
        }else{
            $query = "insert into users(name,email,pass,cpass) values('$user','$email','$pass','$cpass')";
            mysqli_query($conn, $query);
            $message[]='Registered Successfully!!!';
        }
    }

};
if(isset($_POST['signin'])){

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if(empty($user) || empty($pass)){
        $message[] = 'please fill out all';
    }
    else{
        if($user=="admin" && $pass=="admin"){
            header('location: admin.php');
        } 
        $doctor_check_query = "SELECT * FROM doctors WHERE name='$user' AND pass='$pass'";
        $result1 = mysqli_query($conn, $doctor_check_query);
        if (mysqli_num_rows($result1) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'];
            header('location: doctor.php');
        }else{
        $query = "SELECT * FROM users WHERE name='$user' AND pass='$pass'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'];
            header('location: user.html');
          }else{
           $message[] = 'wrong username/password';
        }
    }
}
};
if(isset($message)){
    foreach($message as $message){
       echo '<span class="message">'.$message.'</span>';
    }
 };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container" data-aos="fade-down" data-aous-duration="3000">
        <div class="form-box" id="title" >
            <h1 id="header">Sign up</h1>
            <form action="login.php" method="post">
                <div class="input-group">
                    <div class="input-field" >
                        <i class="fa-solid fa-user fa-fade"></i>
                        <input type="text" placeholder="Username" name="user" >
                    </div>
                    <div class="input-field" id="namefield">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" id="email" name="email" >
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="pass" min="6" max="10">
                    </div>
                    <div class="input-field" >
                        <i class="fa-solid fa-lock"></i>
                        <input type="password"  id="conpassw" name="cpass" placeholder="Confirm password" >
                    </div>
                    
                </div>
                <div class="btn-field">
                    <input type="submit" name="signup" value="Sign up" id="signupbtn">
                    <input type="submit" name="signin" value="Sign in" class="disable"id="signinbtn">
                </div>
            </form>
        </div>
    </div>
    <script>
        let signupBtn=document.getElementById("signupbtn");
        let signinBtn=document.getElementById("signinbtn");
        let nameField=document.getElementById("namefield");
        let header=document.getElementById("header");
        let forgotpassword  =document.getElementById("forgot-password");
        let conpass=document.getElementById("conpassw")
        let email=document.getElementById("email")
        
        signinBtn.onclick=function(){
            nameField.style.maxHeight=0;
            header.innerHTML="Sign in"
            signupBtn.classList.add("disable")
            conpass.classList.add("dontDisplay")
            email.classList.add("dontDisplay")
            signinBtn.classList.remove("disable")
            forgotpassword.classList.remove("dontDisplay")
            
         }

         signupBtn.onclick=function(){
            forgotpassword.classList.add("dontDisplay")
            namefield.style.maxHeight="60px";
            header.innerHTML="Sign up";
            conpass.classList.remove("dontDisplay")
            email.classList.remove("dontDisplay")
            signupBtn.classList.remove("disable")
            signinBtn.classList.add("disable")
            
         }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>