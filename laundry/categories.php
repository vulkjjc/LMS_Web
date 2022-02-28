<?php include('db_connect.php');?>


<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-category">
				<div class="card">
					<div class="card-header">
						    Laundry Prodcut Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Product Name</label>
								<textarea name="name" autocomplete="on" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price pre.</label>
								<input type="number" class="form-control text-right" min="1" step="any" name="price">
							</div>
							<div class="form-group">
								<label class="control-label">Product Categroy :</label>
								<select name="Catogey" class="custom-select al"> 
									<option>Select Category here...</option>
									<?php 
											include 'db_connect.php';
											$cats = $conn->query("SELECT * FROM category");
											while($row=$cats->fetch_assoc()):
									?>	
									<option value="<?php echo  $row['cat_id']; ?>"><?php echo 	 	$row['cat_name']; ?></option>
									<?php endwhile; ?>
		 						</select>
							</div>	
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="save"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				<div class="card mt-5">
					<div class="card-header">
						    Upload Photo of Laundry
				  	</div>
								<form name="photo" id="photo" method="post" enctype="multipart/form-data">
								<div class="py-2">
									<label class="ml-2">Select image to upload:</label>
								<Select name="option" style="width: 75%;margin-left: 12.5%;margin-top: 3%" size="3"  class="form-select">
								<?php 
								$cats = $conn->query("SELECT * FROM products order by product_id asc");
								while($row=$cats->fetch_assoc()):
									$categ=$conn->query("SELECT * FROM category WHERE cat_id='".$row['Category_id']."'");
									while($row1=$categ->fetch_assoc()):
								?>
										<option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name']; echo ","; echo $row1['cat_name'] ?></option>
								<?php endwhile; endwhile; ?>
									
								</Select>
								</div>
								<div class="mt-4" style="width: 75%;margin-left: 12.5%">
  									<input type="file"  name="fileToUpload" id="fileToUpload">
								</div>
								<div class="card-footer mt-3">
  									<div class="col-md-12">
										<button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" onClick="$('#photo').reset().reload()" name="submit"> Save</button>
										<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#photo').get(0).reset()"> Cancel</button>
									</div>
								</div>
								</form>
					</div>
			</div>  
			
			<!-- FORM Panel -->
			
			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Name</th>
									<th class="text-center">Image</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM products order by product_id asc");
								while($row=$cats->fetch_assoc()):
									$categ=$conn->query("SELECT * FROM category WHERE cat_id='".$row['Category_id']."'");
									while($row1=$categ->fetch_assoc()):
										
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Name : <b><?php echo $row['product_name'] ?></b></p>
										<p>Category : <b><?php echo $row1['cat_name'] ?></b></p>
										<p>Price : <b><?php echo number_format($row['product_price'],2) ?></b></p>
									</td>
									<td>
										<?php if(is_null($row['product_image'])): ?>
											<sapn>Image not Uploaded At...</sapn>
										<?php else: ?>
											<img src="assets/img/<?php echo $row['product_image']; ?>" class="img-thumbnail" width="100px" height="125px" alt="Image not Uploaded At...">
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['product_id'] ?>" data-name="<?php echo $row['product_name'] ?>" data-price="<?php echo $row['product_price'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['product_id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	
	
</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
</style>
<?php  if(isset($_POST["submit"])){
		if(isset($_POST['option']))
		{
			$op=$_POST['option'];
			include 'upload1.php';
			if(isset($_SESSION['login_product_img'])){
				$save1 = $conn->query("UPDATE products SET product_image='".$_SESSION['login_product_img']."' where product_id=".$op);
				echo "<script> window.location.assign('index.php?page=categories'); </script>";
			}
			else
			{
				echo "<script>alert('Some thing worng....')</script>";
			}
		}
		else
		{
			echo "<script>alert('Some thing worng....')</script>";
		}
	}
?>

<script>
	$('#manage-category').submit(function(e){
		
		e.preventDefault()
		start_load()
		$.ajax({
		//	url:'upload1.php',
			url:'ajax.php?action=save_category',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==3){
					alert_toast("Data Not Added","danger")
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#manage-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		end_load()
	})
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this category?","delete_cat",[$(this).attr('data-id')])
	})
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_category',
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
})

</script>