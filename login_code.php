<?php
    include("DBClass.php");
    $db = new DBClass();
     session_start();
    //  session_start();

     $username = $_POST['username'];  
     $password = $_POST['password'];  
  
    $query = "SELECT password AS svalue FROM users WHERE username = '" . $_POST['username'] . "'";
    $cpassword = $db->getsinglevalue($query);

        if($password == $cpassword)
        {
            $query = "SELECT id AS svalue FROM users WHERE username = '" . $_POST['username'] . "'";
            $id = $db->getsinglevalue($query);

            header("Location:dashboard.php");
            $_SESSION['username'] = $username;
        }
   
     else
     {
       header("Location:index.php?status=failed");
     }
?>