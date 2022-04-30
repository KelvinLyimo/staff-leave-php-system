<?php
 session_start(); 
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['alogin']) || (trim($_SESSION['alogin']) == '')) { ?>
<script>
window.location = "../index.php";
</script>
<?php
}
$session_id=$_SESSION['alogin'];
$session_depart = $_SESSION['arole'];
    if(isset($_SESSION['dvc'])){
        $roleData =array(
                'status' => 'dvc_status',
                'remark' => 'dvc_remark',
                'actionDate' => 'dvc_action_date',
                'role' => 'DVC',
                'isRead' => 2,
        );
    }
    if (isset($_SESSION['principal'])){
        $roleData = array(
            'status' => 'principal_status',
            'remark' => 'principal_remark',
            'actionDate' => 'principal_action_date',
            'role' => 'Admin',
            'isRead' => 1,
        );
    }
    if (isset($_SESSION['hod'])){
        $roleData = array(
            'status' => 'hod_status',
            'remark' => 'hod_remark',
            'actionDate' => 'hod_action_date',
            'role' => 'HOD',
            'isRead' => 0,
        );
    }

    //function will restrict hod to view and react to other department leave request
    function hodFunc($department){
        if(isset($_SESSION['hod'])){
            if(isset($_SESSION['arole']) AND $_SESSION['arole'] == $department)
                return true;
            else
                return false;
        }else{
            return true;
        }
    }


?>