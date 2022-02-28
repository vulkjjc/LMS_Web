<?php
include "db_connect.php";

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM laundry_list where id =".$_GET['id']);
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;	
	}
}
?>

<div class="container-fluid">
	<form action="" id="manage-laundry">
		<div class="col-lg-12">	
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-6">	
					<div class="form-group">	
						<?php $list1=$conn->query("SELECT * FROM user where id =".$customer_id);
				   				$name;
								while($row=$list1->fetch_assoc()):
				   					$name=$row['first_name']." ".$row['last_name'];
				   				endwhile;
						?>
						<label for="" class="control-label">Customer Name</label>
						<input type="text" class="form-control" placeholder="<?php echo $name ?>" name="customer_name" value="<?php echo $name; ?>">
					</div>
				</div>
				<?php if(isset($_GET['id'])): ?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Status</label>
						<select name="status" id="" class="custom-select browser-default">
							<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Pending</option>
							<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Processing</option>
							<option value="2" <?php echo $status == 2 ? "selected" : '' ?>>Ready to be Claim</option>
							<option value="3" <?php echo $status == 3 ? "selected" : '' ?>>Claimed</option>
						</select>
					</div>
				</div>
				<?php endif;  ?>
				<?php if(isset($_GET['id'])): 
				?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Delivery Man</label>
						<select name="del_id" id="" class="custom-select browser-default">
						<?php 
							
						$list2 = $conn->query("SELECT * FROM delivery_info");
						while($row2=$list2->fetch_assoc()):	
						?>
							<option value="<?php echo $row2['id'] ?>" <?php echo ($del_id==$row2['id']) ? "selected" : '' ?> ><?php echo $row2['name']; ?></option>
						<?php endwhile; ?>
						</select>
					</div>
				</div>	
				<?php endif;  ?>
			</div>
		</div>
	</form>
</div>
<script>
	$('#manage-laundry').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_laundry',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else {
					alert_toast("Some thing worng...",'danger')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})

</script>	