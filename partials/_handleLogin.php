<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $username = $_POST['Loginusername'];
    $userPass = $_POST['Loginpassword'];
    
    $loginsuccess = "false";
    $sql1 = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($connection, $sql1);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($userPass, $row['userPass'])) {
            $success = "true";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['uid'] = $row['userId'];
            header("Location: /forumapp/index.php?loginsuccess=true");
            exit;
        }
    }
    
    header("Location: /forumapp/index.php?loginsuccess=false");
}



?>