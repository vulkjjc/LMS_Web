	<link rel="stylesheet" href="assets/price/cart.css">
	
<script src="assets/price/cart.js"></script>
	<?php require "assets/price/core.php";  
if(!isset($_SESSION['login1_id']))
    echo "<script> window.location.assign('index.php?page=login'); </script>";
?>



<div style="margin-top: 7%"></div>

<div class="card  border-0 shadow rounded-xs bg-light">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
			<form method="post" id="form">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
					<link rel="stylesheet" href="assets/price/cart.css">
					<script src="assets/price/cart.js"></script>
						<?php //require "assets/price/core.php"; ?>
						<?php
						$products = $_CC->cartGetAll();
    					$sub = 0; $total = 0; $que=0; ?>
					<?php 
							if (count($_SESSION['cart'])>0) { foreach ($_SESSION['cart'] as $id => $qty) {
      						$sub = $qty * $products[$id]['product_price'];
      						$total += $sub; $que=$que+$qty; 
							$_SESSION['total']=$total;
							$_SESSION['que']=$que;
					?>
    				<tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
							
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="laundry/assets/img/<?php echo $products[$id]['product_image'];  ?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?= $products[$id]['product_name'] ?></a>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="number" min="1" ma="10" id='qty_<?= $id ?>' onchange="cart.change(<?= $id ?>);start_load();alert_toast('Qty updated....','success');setTimeout(function(){ location.reload() },500)"  value='<?= $qty ?>' class="form-control qty">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>₹<?= $products[$id]['product_price']?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>₹<?= sprintf("%0.2f", $sub) ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger qty1" id="qty1" onclick="cart.remove(<?= $id ?>);start_load();alert_toast('Product Remove....','danger');setTimeout(function(){ location.reload() },500)"><span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>
					<?php }} else { ?>
      				<tr><td colspan="3">Cart is empty</td></tr>
      				<?php } ?>	
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>₹<?= sprintf("%0.2f", $total) ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>₹00</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>₹<?= sprintf("%0.2f", $total) ?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <a href="index.php?page=price"><button type="button" class="btn btn-default" onClick="index.php?page=price">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
							</button></a></td>
                        <td>
							
                        		<button type="submit" name="check" class="btn btn-success" id="done" onClick="myFunction()">
                            		Next <span class="glyphicon glyphicon-play"></span>
								</button>
						</td>
                    </tr>
                </tbody>
            </table>
			</form>
        </div>
    </div>
</div>
<script>	window.alert = null;</script>
<?php
	if(isset($_POST['check'])){
		if($total!="0"){
			echo "<script> window.location.assign('index.php?page=addre'); </script>";
			//include 'addre.php';
		}
	}
	/*			include 'db_connect.php';
		 if($total>"0"){
			$cname=$_SESSION['login1_first_name']." ".$_SESSION['login1_last_name'];
			$st="0";
			$totlam=$total;
			 $qu="INSERT INTO `laundry_list` (`customer_name`, `Status`,`queue`,`total_amount`) VALUES ('".$cname."','".$st."','".$que."','".$totlam."')";
				$qr=$_CC->cartCheckout($qu);
			 	if($qr>0){
					echo "<script> window.location.assign('index.php?page=profile'); </script>";
				}
		 }
	}*/
?>
