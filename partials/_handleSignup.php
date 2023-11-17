<?php
include 'dbconnect.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST['susername'];
    $userPass = $_POST['password'];
    $userCpass = $_POST['cpassword'];
    $showAlert = "false";
    $sql1 = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql1);
    $numRows = mysqli_num_rows($result);
    
    if($numRows>0){
        $showError = "Username is already registered !";
        header("Location: /forumapp/index.php?signupsuccess=false&error=$showError");
        }
        else{
            if($userPass == $userCpass){
                $hash = password_hash($userPass , PASSWORD_DEFAULT);
                $sql2 = "INSERT INTO `users` ( `username`, `userPass`, `timestamp`) VALUES ( '$username', '$hash', current_timestamp())";
                $result = mysqli_query($connection,$sql2);
                if($result){
                    $showAlert = "true";

                    header("Location: /forumapp/index.php?signupsuccess=true");
                    exit();
                }
            }else{
                $showError = "Passwords donot match !";
                header("Location: /forumapp/index.php?signupsuccess=false&error=$showError");
        }
    }

}

?>