<?php error_reporting(0);?>
<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<style>
	input[type="text"]
	{
	    font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
	}

	.btn-outline:hover {
	  color: #fff;
	  background-color: #524d7d;
	  border-color: #524d7d; 
	}

	textarea { 
		font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
	}

	textarea.text_area{
        height: 8em;
        font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
      }

	</style>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/success.png" alt=""><h4>Leave management System</h4></div>
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
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>LEAVE DETAILS</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Leave</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Leave Details</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<form method="post" action="">
						<?php 
						if(!isset($_GET['edit']) && empty($_GET['edit'])):
							header('Location: index.php');
						else:
                                $lid=intval($_GET['edit']);
                                $sql = "SELECT tblleaves.id as lid,tblemployees.*,tblleaves.* from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id=:lid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':lid',$lid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0):
                                    foreach($results as $result):
                                        ?>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Full Name</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->FirstName." ".$result->LastName);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Email Address</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->EmailId);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Gender</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-success" readonly value="<?php echo htmlentities($result->Gender);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Phone Number</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->Phonenumber);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Leave Type</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->LeaveType);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Applied Date</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-success" readonly value="<?php echo htmlentities($result->PostingDate);?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Applied No. of Days</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->num_days);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Available No. of Days</b></label>
                                                        <input type="text" class="form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Av_leave);?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label style="font-size:16px;"><b>Leave Period</b></label>
                                                        <input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="From <?= date('d/m/Y', strtotime($result->FromDate)) ?> to <?= date('d/m/Y', strtotime($result->ToDate)) ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label"><b>Leave Reason</b></label>
                                                    <div class="col-sm-12 col-md-12 bg-light-gray pt-2" style="min-height:100px; border-radius: 5px; ">
                                                        <?php echo htmlentities($result->Description);?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12 table-responsive">
                                                   <table class="table table-bordered">
                                                       <thead>
                                                           <tr>
                                                               <th>Administer</th>
                                                               <th>Status</th>
                                                               <th title="date of action">Date</th>
                                                               <th>Remark</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                            <!--  HOD -->
                                                           <tr>
                                                               <td class="text-center">HOD<br><small class="text-default">(Head of Department)</small></td>
                                                               <td>
                                                                   <?php
                                                                       if($result->hod_status == 0):
                                                                           echo ' <small class="badge text-secondary" >Pending</small>';
                                                                       elseif ($result->hod_status == 1):
                                                                           echo ' <small class="badge text-success" >Approved</small>';
                                                                       elseif ($result->hod_status == 2):
                                                                           echo ' <small class="badge text-danger" >Rejected</small>';
                                                                       endif;
                                                                   ?>
                                                               </td>
                                                               <td class="text-muted text-center">
                                                                   <small>
                                                                       <?php if($result->hod_status != 0){ echo date('d M, Y H:ia', strtotime($result->hod_action_date)); } else{ echo '--'; } ?>
                                                                   </small>
                                                               </td>
                                                               <td><small class="text-justify"> <?php if($result->hod_status != 0){ echo $result->hod_remark; } ?></small></td>
                                                           </tr>

                                                            <!--  Principal -->
                                                           <tr>
                                                               <td class="text-center">Principal<br><small class="text-default">(Head of College)</small></td>
                                                               <td>
                                                                   <?php
                                                                   if($result->principal_status == 0):
                                                                       echo ' <small class="badge text-secondary" >Pending</small>';
                                                                   elseif ($result->principal_status == 1):
                                                                       echo ' <small class="badge text-success" >Approved</small>';
                                                                   elseif ($result->principal_status == 2):
                                                                       echo ' <small class="badge text-danger" >Rejected</small>';
                                                                   endif;
                                                                   ?>
                                                               </td>
                                                               <td class="text-muted text-center">
                                                                   <small>
                                                                       <?php if($result->principal_status != 0){ echo date('d M, Y H:ia', strtotime($result->principal_action_date)); } else{ echo '--'; } ?>
                                                                   </small>
                                                               </td>
                                                               <td><small class="text-justify"> <?php if($result->principal_status != 0){ echo $result->principal_remark; } ?></small></td>
                                                           </tr>

                                                            <!--  DVC -->
                                                           <tr>
                                                               <td class="text-center">DVC<br><small class="text-default">(Depute Vice Chancellor)</small></td>
                                                               <td>
                                                                   <?php
                                                                   if($result->dvc_status == 0):
                                                                       echo ' <small class="badge text-secondary" >Pending</small>';
                                                                   elseif ($result->dvc_status == 1):
                                                                       echo ' <small class="badge text-success" >Approved</small>';
                                                                   elseif ($result->dvc_status == 2):
                                                                       echo ' <small class="badge text-danger" >Rejected</small>';
                                                                   endif;
                                                                   ?>
                                                               </td>
                                                               <td class="text-muted text-center">
                                                                   <small>
                                                                       <?php if($result->dvc_status != 0){ echo date('d M, Y H:ia', strtotime($result->dvc_action_date)); } else{ echo '--'; } ?>
                                                                   </small>
                                                               </td>
                                                               <td><small class="text-justify"> <?php if($result->dvc_status != 0){ echo $result->dvc_remark; } ?></small></td>
                                                           </tr>


                                                       </tbody>


                                                   </table>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <button class="btn btn-sm btn-block btn-success">print report</button>
                                            </div>

                                            

                                        <?php
                                    endforeach;
                                endif;
						endif; ?>
					</form>
				</div>

			</div>
			
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>