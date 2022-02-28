<?php include 'db_connect.php';
	 if(!isset($_SESSION['login1_id'])){
    echo "<script> window.location.assign('index.php?page=login'); </script>";
	 }
?>
	 <div class="container-fluid">
		 <div style="margin-left: 50%;margin-top: 30px;"><h3 class="text-dark mb-4" >Profile</h3></div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class=" card mb-5">
                <div class="card-body text-center mb-4"><i class="fas fa-user fa-10x mb-5 mt-5 rounded-circle mb-3 mt-4"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="<?php echo $_SESSION['login1_user_mail']; ?>" name="email" /></div>
                                    </div>
									<div class="col">
                                        <div class="form-group"><label for="username"><strong>Phone Number</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_phone']; ?>" name="username" /></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_first_name']; ?>" name="first_name" /></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_last_name']; ?>" name="last_name" /></div>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</div>
    </div>
</div>




		<div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3" >
                            <p class="text-primary m-0 font-weight-bold">Pervsious Order</p>
                        </div>
					<div class="card-body">	
						<div class="row ml-1 mr-1">		
							<table class="table table-bordered" id="laundry-list">
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Customer Name</th>
										<th class="text-center">Total Amount</th>
										<th class="text-center">Status</th>
										<th class="text-center">Print</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$list = $conn->query("SELECT * FROM laundry_list WHERE customer_id='".$_SESSION['login1_id']."' order by status asc, id DESC LIMIT 5 ");
									$i=0;
									while($row=$list->fetch_assoc()):								
									$i=1;
									
									$list1 = $conn->query("SELECT * FROM user WHERE id=".$_SESSION['login1_id']);
									
									while($row1=$list1->fetch_assoc()):	
									?>
									<tr>
										<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
										<td class="text-center"><?php echo $row1['first_name']." ".$row1['last_name']; ?></td>
										<td class=""><?php echo $row['total_amount'] ?></td>
										<?php if($row['status'] == 0): ?>
											<td class="text-center bg-secondary"><span class="badge badge-secondary" style="font-size:  16px;">Pending</span></td>
										<?php elseif($row['status'] == 1): ?>
											<td class="text-center bg-primary"><span class="badge badge-primary" style="font-size:  16px;">Processing</span></td>
										<?php elseif($row['status'] == 2): ?>
											<td class="text-center bg-info"><span class="badge badge-info" style="font-size:  16px;" >Ready to be Claim</span></td>
										<?php elseif($row['status'] == 3): ?>
											<td class="text-center bg-success"><span class="badge badge-success" style="font-size:  16px;">Claimed</span></td>
										<?php endif; ?>
										<form action="" method="post"><td class="text-center"><p><button type="submit" class="btn btn-primary btn-sm" name="print" value="<?php echo $row['id']; ?>" ><i class="fas fa-print"></i>Print</button></p></td></form>
									</tr>
									<?php endwhile; endwhile; if($i==0): ?>
									<tr>
										<td class="text-center" colspan="5"><h5><b>Nothing order yet...</b></h5></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
						<div class="card-footer text-center"><a href="index.php?page=reports">View All Order</a></div>	
					</div>
				</div>
			</div>	
		</div>
<?php 
	if(isset($_POST['print']))
	{
		$id=$_POST['print'];
		//echo "<script>alert('".$id."');</script>";
		
		$_SESSION['bill_id']=$id;
		echo "<script> window.location.assign('index.php?page=bills'); </script>";
	}
?>