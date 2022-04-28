<?php
@session_start();
include('../includes/config.php');
if(isset($_POST['signin']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);


    $sql ="SELECT * FROM tblemployees where EmailId ='$username' AND Password ='$password'";
    $query= mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0)
    {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['role'] == 'Admin') {
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                header("location: ../admin/admin_dashboard.php");
            }
            elseif ($row['role'] == 'Staff') {
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                header("location: ../staff/index.php");
            }
            else {
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                header("location : ../heads/index.php");
            }
        }

    }
    else{
        $_SESSION['failed']="incorrect username or password";
        header("location: ../");

    }

}

