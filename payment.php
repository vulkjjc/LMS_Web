<script src="assets/price/cart.js"></script>
	<?php require "assets/price/core.php"; if(!isset($_SESSION['login1_id']))
    echo "<script> window.location.assign('index.php?page=login'); </script>"; ?>


<div class="container-fluid" style="width: 95%;margin-left: 2.5%;margin-top: 5%">
<div class="card shadow" id>
<div class="card-header py-3">
      <p class="text-primary m-0 font-weight-bold">Payment Methods</p>
</div>
 <div class="card-body">
	<div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#cash_on" class="nav-link   active "> <i class="fas fa-money-bill mr-2"></i> Cash On </a> </li>
							<li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> PayTm </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show  pt-3">
                            <form role="form"  onsubmit="event.preventDefault()">
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input disabled type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input disabled type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input disabled type="number" placeholder="MM" name="" class="form-control" required> <input type="number" disabled placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input disabled type="text" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button disabled type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                            </form>
							<span class="text-danger">Note: Online Payment Not Available Now.</span>
                        </div>
                    </div> <!-- End -->
                    <!-- Paytm info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <p> <button disabled type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into my PayTm</button> </p>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
						<span class="text-danger">Note: Online Payment Not Available Now.</span>
                    </div> <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select disabled class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank 1</option>
                                <option>Bank 2</option>
                                <option>Bank 3</option>
                                <option>Bank 4</option>
                                <option>Bank 5</option>
                                <option>Bank 6</option>
                                <option>Bank 7</option>
                                <option>Bank 8</option>
                                <option>Bank 9</option>
                                <option>Bank 10</option>
                            </select> </div>
                        <div class="form-group">
                            <p> <button disabled type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button> </p>
                        </div>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
						<span class="text-danger">Note: Online Payment Not Available Now.</span>
                    </div> <!-- End -->
					<div id="cash_on" class="tab-pane show fade active pt-3">
						 <div class="form-group">
							 <form action="" method="post" id="manage-laundry">
                            <p> <button type="submit" name="submit" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Confirm Order</button> </p>
							</form>
                        </div>
						<p class="text-muted">Note: After clicking on the button, Order will be generated. you will not cancel order after given. </p>
					</div>
                    <!-- End -->
                </div>
            </div>
        </div>
	</div>
</div>
</div>
</div>
	
<?php 
	//echo "<script>alert('ok1');</script>";
if(isset($_POST['submit'])){	
		//echo "<script>alert('ok2');</script>";
		/*include 'db_connect.php';
		$cname=$_SESSION['login1_first_name']." ".$_SESSION['login1_last_name'];
		$st="0";
		$totlam=$_SESSION['total'];
		$add=$_SESSION['address'];
		$qu=$_SESSION['que'];
		$data = " customer_name = '$cname' ";
		$data .= ", Status = '$st'";
		$data .= ", total_amount = '$totlam' ";
		$data .= ", queue = '$qu'";
		$data .= ", address = '$add'";
			$qr = $this->db->query("INSERT INTO laundry_list set ".$data);
		$qr=$_CC->cartCheckout($qu);
			 	if($qr>0){
					echo "<script> window.location.assign('index.php?page=home'); </script>";
				}*/
	
		$cname=$_SESSION['login1_id'];
		$st="0";
		$totlam=$_SESSION['total'];
		$add=$_SESSION['address'];
		$qu=$_SESSION['que'];
	//echo "<script>alert('ok3');</script>";
	include 'db_connect.php';
		 if($totlam>"0"){
			 //echo "<script>alert('ok4');</script>";
			 $qu="INSERT INTO `laundry_list` (`customer_id`, `Status`,`queue`,`total_amount`,`address`) VALUES ('".$cname."','".$st."','".$qu."','".$totlam."','".$add."')";
				$qr=$_CC->cartCheckout($qu);
			 	if($qr>0){
					$list = $conn->query("SELECT * FROM laundry_list WHERE customer_id='".$_SESSION['login1_id']."' order by id DESC LIMIT 1 ");
					$id;
									while($row=$list->fetch_assoc()):
										$id=$row['id'];
									endwhile;
					$_SESSION['bill_id']=$id;
					$sql = $conn->query("INSERT INTO `payment` (`order_id`, `user_id`, `method`) VALUES ('".$id."','".$_SESSION['login1_id']."','1') ");
					//echo "<script>alert('".$id."');</script>";
					echo "<script> window.location.assign('index.php?page=bills'); </script>";
				}
		 }
}
				
 ?>

	
<script>
/*
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
				else{
					alert_toast("Data successfully not updated",'danger')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	
</script>