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
					<table class="table table-bordered" id="laundry-list">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>QTY</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$list = $conn->query("SELECT * FROM orders_items Where order_id=".$_GET['id']);
									while($row=$list->fetch_assoc()):
							?>
							<tr>
								<?php 
									$list1 = $conn->query("SELECT * FROM products Where product_id=".$row['product_id']);
									while($row1=$list1->fetch_assoc()):
										$list2 = $conn->query("SELECT * FROM category Where cat_id=".$row1['Category_id']);
										while($row2=$list2->fetch_assoc()):
								?>
								<td><?php echo $row1['product_name']." , ".$row2['cat_name']; ?></td>
								<?php endwhile; endwhile; ?>
								<td><?php echo $row['quantity']; ?></td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	$('#manage-laundry').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=show_laundry',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
						location.reload()

				}
			}
		})
	})

</script>