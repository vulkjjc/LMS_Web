<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">	
			<div class="card">
				<div class="text-center card-header text-primary"><b><h5>Take way...</h5></b></div>
				<div class="card-body">	
					<div class="row">
						<div class="col-md-12">		
							<table class="table table-bordered" >
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Totla Laundry</th>
										<th class="text-center">Customer Name</th>
										<th class="text-center">Info</th>
										<th class="text-center">Contact No.</th>
										<th class="text-center">Laundry Item</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$list = $conn->query("SELECT * FROM laundry_list WHERE status =0 AND del_id='".$_SESSION['del_id']."' order by status asc, id asc ");
									while($row=$list->fetch_assoc()):
										$list1=$conn->query("SELECT * FROM user WHERE id='".$row['customer_id']."'");
										while($row1=$list1->fetch_assoc()):
									?>
									<tr>
										<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
										<td class="text-right"><?php echo $row['queue'] ?></td>
										<td class=""><?php echo ucwords($row1['first_name']." ".$row1['last_name']); ?></td>
										<td class=""><?php echo $row['address']; ?></td>
										<td class=""><?php echo $row1['phone']; ?></td>
										<td class=""><button class="btn btn-outline-primary btn-sm show" onClick=""  data-id="<?php echo $row['id'] ?>">Show Laundry</button></td>
									</tr>
									<?php endwhile; endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
	</div>	
</div>

<div class="container-fluid mt-5">
	<div class="col-lg-12">	
			<div class="card">
				<div class="text-center card-header text-primary"><b><h5>Delivery...</h5></b></div>
				<div class="card-body">	
					<div class="row">
						<div class="col-md-12">		
							<table class="table table-bordered" >
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Totla Laundry</th>
										<th class="text-center">Customer Name</th>
										<th class="text-center">Info</th>
										<th class="text-center">Contact No.</th>
										<th class="text-center">Payment Status</th>
										<th class="text-center">Laundry Item</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$list = $conn->query("SELECT * FROM laundry_list WHERE status =3 AND del_id='".$_SESSION['del_id']."' order by status asc, id asc ");
									while($row=$list->fetch_assoc()):
										$list1=$conn->query("SELECT * FROM user WHERE id='".$row['customer_id']."'");
										while($row1=$list1->fetch_assoc()):
									?>
									<tr>
										<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
										<td class="text-right"><?php echo $row['queue'] ?></td>
										<td class=""><?php echo ucwords($row1['first_name']." ".$row1['last_name']); ?></td>
										<td class=""><?php echo $row['address']; ?></td>
										<td class=""><?php echo $row1['phone']; ?></td>
										<td class=""><button class="btn btn-outline-primary btn-sm show" onClick=""  data-id="<?php echo $row['id'] ?>">Show Laundry</button></td>
									</tr>
									<?php endwhile; endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
	</div>	
</div>

<script>
	$('.show').click(function(){
		uni_modal('Show Laundry','data_laundry.php?id='+$(this).attr('data-id'),'mid-large')
	})
	$('#new_laundry').click(function(){
		uni_modal('New Laundry','manage_laundry.php','mid-large')
	})
	$('.edit_laundry').click(function(){
		uni_modal('Edit Laundry','manage_laundry.php?id='+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_laundry').click(function(){
		_conf("Are you sre to remove this data from list?","delete_laundry",[$(this).attr('data-id')])
	})
	$('#laundry-list').dataTable()
	function delete_laundry($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_laundry',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}

</script>