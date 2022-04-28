<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
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

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Leave Portal</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pending Leave</li>
								</ol>
							</nav>
					</div>
				</div>
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">PENDING LEAVES</h2>
					</div>
				<div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus">Name</th>
                            <th class="table-plus">LEAVE TYPE</th>
                            <th>DATE</th>
                            <th>DAYS</th>
                            <th>HOD</th>
                            <th>Principal</th>
                            <th>DVC</th>
                            <th class="datatable-nosort"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = 0;
                        $sql = "SELECT tblleaves.id as lid,tblemployees.*,tblleaves.* from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.".$roleData['status']."=:status and tblleaves.IsRead='".$roleData['isRead']."' order by lid desc limit 15";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':status',$status,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                        $cnt=1;
                        if($query->rowCount() > 0):
                            foreach($results as $result):
                                echo '<tr>';
                                echo '<td>'.htmlentities($result->FirstName." ".$result->FirstName).'</td>';
                                echo '<td>'.htmlentities($result->LeaveType).'</td>';
                                echo '<td>'.date("d M, Y", strtotime($result->PostingDate)).'</td>';
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
                                                            <a title="VIEW" href="leave_details.php?leaveid='.htmlentities($result->id).'" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>
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

	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	
	<script src="../vendors/scripts/datatable-setting.js"></script></body>
</body>
</html>