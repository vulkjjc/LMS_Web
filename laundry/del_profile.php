<?php include 'db_connect.php';
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
                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="<?php echo $_SESSION['del_email']; ?>" name="email" /></div>
                                    </div>
									<div class="col">
                                        <div class="form-group"><label for="username"><strong>Phone Number</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['del_phone']; ?>" name="username" /></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>Name</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['del_name']; ?>" name="first_name" /></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save</button></div>
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
									</tr>
								</thead>
								<tbody>
									<?php 
									$list = $conn->query("SELECT * FROM laundry_list WHERE del_id='".$_SESSION['del_id']."' order by status asc, id DESC LIMIT 5 ");
									$i=0;
									while($row=$list->fetch_assoc()):								
									$i=1;
									
									$list1 = $conn->query("SELECT * FROM user WHERE id=".$row['customer_id']);
									
									while($row1=$list1->fetch_assoc()):	
									?>
									<tr>
										<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
										<td class="text-center"><?php echo $row1['first_name']." ".$row1['last_name']; ?></td>
										<td class=""><?php echo $row['total_amount'] ?></td>
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
						<div class="card-footer text-center"><a href="index.php?page=del_report">View All Order</a></div>	
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