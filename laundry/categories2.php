<?php include('db_connect.php');?>


<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-category">
				<div class="card">
					<div class="card-header">
						    Laundry Category Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Category Name</label>
								<textarea name="name"  required id="" cols="30" rows="2" class="form-control"></textarea>
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
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM category WHERE cat_id!=0 order by cat_id asc");
								while($row=$cats->fetch_assoc()):	
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Name : <b><?php echo $row['cat_name'] ?></b></p>
									</td>
									
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['cat_id'] ?>" data-name="<?php echo $row['cat_name'] ?>" >Edit</button>
									</td>
								</tr>
								<?php endwhile; ?>
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
			url:'ajax.php?action=save_category2',
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

</script>