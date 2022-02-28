	<?php 
		if(isset($_POST['search']))
		{
			$valtosearch=$_POST['Searchval'];
			$query="SELECT * FROM `products` WHERE product_name LIKE '%".$valtosearch."%'";
		}
		else if(isset($_POST['Catogey']))
		{
			$op=$_POST['Catogey'];
			//echo "<script>alert('".$op."')</script>";
			if($op!="1"){
				$query="SELECT * FROM `products` WHERE Category_id='".$op."'";
			}
			else
				$query="SELECT * FROM `products`";	
			
		}
		else
		{
			$query="SELECT * FROM `products`";
		}	
	?>
<div class="mt-1 py-1" onload="showAlert()">
  <div class="container-fluid mt-5">
	<form class="fomr-inlne" action="index.php?page=price" method="post">
	<div class="row">
	  <div class="col-sm-7 col-md-4 col-lg-4">
		<div id="search"><input id="input"  placeholder="Search..." name="Searchval"> <button type="submit" id="button" name="search"><i class="fa fa-search"></i></button></div>
		</div>
		<div class="col-sm-5 col-md-5 col-lg-5"><div class="toast">Item add</div></div>
	  <div class="col-sm-2 col-md-4 col-lg-3 mt-3">
  		<select name="Catogey" class="custom-select al"  onChange="this.form.submit();"> 
			<option>Select Category here...</option>
			<?php 
				include 'db_connect.php';
				$cats = $conn->query("SELECT * FROM category");
								while($row=$cats->fetch_assoc()):
			?>
			<option value="<?php echo  $row['cat_id']; ?>"><?php echo  $row['cat_name']; ?></option>
			<?php endwhile; ?>
		 </select>
	  </div>
	</div>
   </form>
  </div>
</div>

					
		<link rel="stylesheet" href="assets/price/cart.css">
	
	<div class="container-fluid px-5 py-5 mx-auto">
		<div id="textHint" class="row justify-content-between px-3">
			<script src="assets/price/cart.js"></script>
		<?php
			
		
      // (B1) GET PRODUCTS
      require "assets/price/core.php";
      $products = $_CC->pdtGetAll($query);

      // (B2) LIST PRODUCTS
      if (is_array($products)) { foreach ($products as $id => $row) { ?>
	
		<div class="block text-center"> <img class="image" src="laundry\assets\img\<?php echo $row['product_image'];?>">
			<div class="info py-2 px-2">
				<div class="row px-3">
					<?php if(!is_null($_SESSION['login1_id'])): ?>
						<button class="btn btn-block btn-outline-primary add" type="button" value="Add to cart" onclick="cart.add(<?php echo $row['product_id']; ?>);"/>Add to cart</button>
					<?php else: ?>
						<button class="btn btn-block btn-outline-primary add1" type="button" value="Add to cart" onclick=" window.location.assign('index.php?page=login'); "/>Add to cart</button>
					<?php endif; ?>
				</div>
				<div class="text-left">
					<h5 class="mb-0 mt-2"><?php echo $row['product_name'];?></h5> <small class="text-muted mb-1"><?php $cats = $conn->query("SELECT * FROM category WHERE cat_id=".$row['Category_id']);
										while($row2=$cats->fetch_assoc()):
											echo $row2['cat_name'];
										endwhile;
									?></small>
				</div>
				<div class="row px-3">
					<h5>₹<?php echo $row['product_price'];?>&nbsp;&nbsp;<?php   echo $row['product_description'];?></h5>
					<!--<p class="text-muted ml-2"><del>35.00 INR/Cloth</del></p>-->
				</div>
			</div>
		</div>
			<?php } }  else { echo "No products found."; }
    ?>
	</div>
</div>
<script>
	window.alert = null;
$('.add').click(function(){
		start_load();
		alert_toast('Item Added....','success');
		setTimeout(function(){
						location.reload()
		},500)

})
</script>
	