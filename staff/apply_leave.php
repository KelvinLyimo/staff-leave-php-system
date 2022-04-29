<?php
@include('includes/header.php');
@include('../includes/session.php');


function isDate($dateString){
    return (bool)strtotime($dateString);
}


$emp_id = $_SESSION['alogin'];
$session_depart = $_SESSION['arole'];

 $leave_days = $_SESSION['leaveDay'];
 $sql = "SELECT  *  from tblleaves where tblleaves.empid='{$emp_id}' and dvc_status='1'  ";
 $query = $dbh -> prepare($sql);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 $signedLeaveDay = $leave_days;
 foreach($results as $result):
	 if( date('Y', strtotime($result->ToDate)) === date('Y') )
		 $signedLeaveDay -= $result->num_days ;
 endforeach;
 if($signedLeaveDay < 0):
	$signedLeaveDay = 0;
    $_SESSION['warning']="Sorry you have reach maximum leave application request";
 endif;


	if(isset($_POST['apply'])){
        $leave_type=$_POST['leave_type'];



        if(!date_create($_POST['date_from']) and !date_create($_POST['date_to'])){
            $_SESSION['failed']="Please insert correct date format";
           header("Refresh:0");
           exit();
        }




        $fromdate=date('Y-m-d', strtotime($_POST['date_from']));
        $todate=date('Y-m-d', strtotime($_POST['date_to']));
        $description=$_POST['description'];
       $leave_days=$_POST['$leave_days'];
        $datePosting = date("Y-m-d");

        if(strtotime($_POST['date_from'])  > strtotime($_POST['date_to'])){
            $_SESSION['failed']="End Date should be greater than Start Date";
        }elseif($leave_days <= 0){
            $_SESSION['failed']="You have Exceeded Your Leave Limit";
        }else{
            $DF = date_create($_POST['date_from']);
            $DT = date_create($_POST['date_to']);

            $diff =  date_diff($DF , $DT );
            $num_days = (1 + $diff->format("%a"));
            if($num_days > $signedLeaveDay){
                $_SESSION['failed']="Sorry you can't request more than ".$signedLeaveDay." Days";
                header("Refresh:0");
                exit();
            }

            $nullData = '';
            $isRead = 0;

            $sql="INSERT INTO tblleaves(LeaveType, ToDate, FromDate, Description, PostingDate, hod_remark, principal_remark, principal_action_date, hod_action_date, dvc_action_date, hod_status, principal_status, IsRead, empid, num_days, dvc_status, dvc_remark) VALUES(:LeaveType, :ToDate, :FromDate, :Description, :PostingDate, :hod_remark, :principal_remark, :principal_action_date, :hod_action_date, :dvc_action_date, :hod_status, :principal_status, :IsRead, :empid, :num_days, :dvc_status, :dvc_remark)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':LeaveType',$leave_type,PDO::PARAM_STR);
            $query->bindParam(':FromDate',$fromdate,PDO::PARAM_STR);
            $query->bindParam(':ToDate',$todate,PDO::PARAM_STR);
            $query->bindParam(':Description',$description,PDO::PARAM_STR);
            $query->bindParam(':num_days',$num_days,PDO::PARAM_STR);
            $query->bindParam(':PostingDate',$datePosting,PDO::PARAM_STR);
            $query->bindParam(':hod_remark',$nullData,PDO::PARAM_STR);
            $query->bindParam(':principal_remark',$nullData,PDO::PARAM_STR);
            $query->bindParam(':dvc_remark',$nullData,PDO::PARAM_STR);
            $query->bindParam(':principal_action_date',$nullData,PDO::PARAM_STR);
            $query->bindParam(':hod_action_date',$nullData,PDO::PARAM_STR);
            $query->bindParam(':dvc_action_date',$nullData,PDO::PARAM_STR);
            $query->bindParam(':hod_status',$nullData,PDO::PARAM_STR);
            $query->bindParam(':principal_status',$nullData,PDO::PARAM_STR);
            $query->bindParam(':IsRead',$isRead,PDO::PARAM_STR);
            $query->bindParam(':empid',$emp_id,PDO::PARAM_STR);
            $query->bindParam(':dvc_status',$nullData,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

		if($lastInsertId){
            $_SESSION['success']="Leave Application was successful";
			header('location: leave_history.php');
		}
		else {
            $_SESSION['failed']="Something went wrong. Please try again";
		}

	}

}

?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/success.png" alt=""><h4>Leave Management System</h4></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pb-20">
			<div style="min-height: 90vh">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Leave Application</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Apply for Leave</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Staff Form</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<div class="wizard-content">
                        <div class="col-md-12">
                            <?php include_once("../includes/message.php"); ?>
                        </div>

                        <?php if($signedLeaveDay > 0): ?>

						    <form method="post" action="">
							<section>

								<?php if ($role_id = 'Staff'): ?>
								<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
									$row = mysqli_fetch_array($query);
								?>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label >First Name </label>
											<input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label >Last Name </label>
											<input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Email Address</label>
											<input name="email" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['EmailId']; ?>">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Available Leave Days </label>
											<input name="$leave_days" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?= $signedLeaveDay  ?>">
										</div>
									</div>
									<?php endif ?>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Leave Type :</label>
											<select name="leave_type" class="custom-select form-control" required="true" autocomplete="off">
											<option value="">Select leave type...</option>
											<?php $sql = "SELECT  LeaveType from tblleavetype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{   ?>                                            
											<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
											<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Start Leave Date :</label>
											<input name="date_from" type="text" class="form-control date-picker" required="true" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>End Leave Date :</label>
											<input name="date_to" type="text" class="form-control date-picker" required="true" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 col-sm-12">
										<div class="form-group">
											<label>Reason For Leave :</label>
											<textarea id="textarea1" name="description" class="form-control" required length="150" maxlength="150" required="true" autocomplete="off"></textarea>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Apply&nbsp;Leave</button>
											</div>
										</div>
									</div>
								</div>
							</section>
						</form>

                        <?php endif; ?>
					</div>
				</div>

			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php')?>
</body>
</html>