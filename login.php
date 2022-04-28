<?php
@session_start();
include('includes/config.php');
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
            $_SESSION['leaveDay']=$row['Av_leave'];
            if ($row['role'] == 'Admin') {
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['principal']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                $_SESSION['path']= "admin/admin_dashboard.php";
                header("location: admin/admin_dashboard.php");
            }
            elseif ($row['role'] == 'Staff') {
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                $_SESSION['path']= "staff/index.php";
                header("location: staff/index.php");
            }
            else {
                if($row['role'] == 'DVC'){
                    $_SESSION['dvc']=$row['emp_id'];
                }else{
                    $_SESSION['hod']=$row['emp_id'];
                }
                $_SESSION['alogin']=$row['emp_id'];
                $_SESSION['arole']=$row['Department'];
                $_SESSION['path']= "heads/index.php";
                header("location: heads/index.php");
            }
        }

    }
    else{
        $_SESSION['failed']="incorrect username or password";
        header("location: index.php");

    }

}

