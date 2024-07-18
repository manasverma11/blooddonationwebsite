<?php 
session_start();
$con = new mysqli("localhost","root","","majorproject");
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from admin where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){ 
            $_SESSION['username'] = $username;  
            $_SESSION['password'] = $password; 
            header("location:admin.php?info=success");
            exit();
        }  
        else{  
            header("location:index.php?info=fail");
            exit();
        }     
?>  