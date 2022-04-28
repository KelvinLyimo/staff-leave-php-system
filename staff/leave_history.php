<?php
    include('includes/header.php');
    include('../includes/session.php');
  $staff_id = $session_id=$_SESSION['alogin'];
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblemployees where emp_id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Staff deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
		
	}
}

?>

<body>


	<?php  include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="title pb-20">
				<h2 class="h3 mb-0">Leave Breakdown</h2>
			</div>
			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php

						$sql = "SELECT id from tblleaves";
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$empcount=$query->rowCount();

						?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>
								<div class="font-14 text-secondary weight-500">All Applied Leave</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-user-2"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php
						 $query = mysqli_query($conn,"select * from tblleaves where empid = '{$staff_id}' AND dvc_status = '1'");
						 $count_reg_staff = mysqli_num_rows($query);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo htmlentities($count_reg_staff); ?></div>
								<div class="font-14 text-secondary weight-500">Approved</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><span class="icon-copy fa fa-hourglass"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php
						 $query_pend = mysqli_query($conn,"select * from tblleaves where empid = '$session_id' AND dvc_status = '0'");
						 $count_pending = mysqli_num_rows($query_pend);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($count_pending); ?></div>
								<div class="font-14 text-secondary weight-500">Pending</div>
							</div>
							<div class="widget-icon">
								<div class="icon"><i class="icon-copy fa fa-hourglass-end" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php
						 $query_reject = mysqli_query($conn,"select * from tblleaves where empid = '$session_id' AND dvc_status = '2'");
						 $count_reject = mysqli_num_rows($query_reject);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($count_reject); ?></div>
								<div class="font-14 text-secondary weight-500">Rejected</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">ALL MY LEAVE</h2>
					</div>
                <div class="pb-20 table-responsive">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus">LEAVE TYPE</th>
                            <th>DATE FROM</th>
                            <th>DATE TO</th>
                            <th>NO. OF DAYS</th>
                            <th>HOD</th>
                            <th>Principal</th>
                            <th>DVC</th>
                            <th class="datatable-nosort"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * from tblleaves where empid = '$session_id'";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0):
                            foreach($results as $result):
                                echo '<tr>';
                                echo '<td>'.htmlentities($result->LeaveType).'</td>';
                                echo '<td>'.htmlentities($result->FromDate).'</td>';
                                echo '<td>'.htmlentities($result->ToDate).'</td>';
                                echo '<td>'.htmlentities($result->num_days).'</td>';
                                echo '<td>';
                                if($result->hod_status == 0):
                                    echo ' <small class="badge text-secondary" >Pending</small>';
                                elseif ($result->hod_status == 1):
                                    echo ' <small class="badge text-success" >Approved</small>';
                                elseif ($result->hod_status == 2):
                                    echo ' <small class="badge text-danger" >Rejected</small>';
                                endif;
                                echo '</td>';
                                echo '<td>';
                                if($result->principal_status == 0):
                                    echo ' <small class="badge text-secondary" >Pending</small>';
                                elseif ($result->principal_status == 1):
                                    echo ' <small class="badge text-success" >Approved</small>';
                                elseif ($result->principal_status == 2):
                                    echo ' <small class="badge text-danger" >Rejected</small>';
                                endif;
                                echo '</td>';
                                echo '<td>';
                                if($result->dvc_status == 0):
                                    echo ' <small class="badge text-secondary" >Pending</small>';
                                elseif ($result->dvc_status == 1):
                                    echo ' <small class="badge text-success" >Approved</small>';
                                elseif ($result->dvc_status == 2):
                                    echo ' <small class="badge text-danger" >Rejected</small>';
                                endif;
                                echo '</td>';
                                echo '<td> 
                                                        <div class="table-actions">
                                                            <a title="VIEW" href="view_leave.php?edit='.htmlentities($result->id).'" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>
                                                         </div>
                                                      </td>';
                                echo '</tr>';
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>