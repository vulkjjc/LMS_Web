<?php 
if(!isset($_SESSION['login1_id']))
    echo "<script> window.location.assign('index.php?page=login'); </script>";
	if(!isset($_SESSION['bill_id']))
		echo "<script> window.location.assign('index.php?page=home'); </script>";
?>
<div class="container mt-5 mb-5"  id="printablediv">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
					<div class="col-md-1 float-left" style="display: flex;">
  						<div class="logo">
  							<div class="laundry-logo"></div>
  						</div>
  					</div>
					<div class="col-md-4 float-left text-dark mt-3 ml-2">
        				<h5><b>LMS</b></h5>
      				</div>
				</div>
                <div class="invoice p-5">
                    <h5>Your order Confirmed!</h5> <span class="font-weight-bold d-block mt-4">Hello, <?php include 'db_connect.php';    echo $_SESSION['login1_first_name']." ".$_SESSION['login1_last_name']; ?></span> <span>You order has been confirmed and will be Take away in next two days!</span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
								<?php 
									
									$list = $conn->query("SELECT * FROM laundry_list WHERE id = '".$_SESSION['bill_id']."' order by id DESC LIMIT 1 ");
									$od; $total;
									while($row=$list->fetch_assoc()):
									$total=$row['total_amount'];
								?>
                                <tr>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span><?php echo date("M d, Y",strtotime($row['date_created'])) ?></span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order No</span> <span>#<?php $od=$row['id']; $num_padded = sprintf("%07d", $row['id']); echo $num_padded; ?></span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Payment</span> <span><i class="fas fa-money-bill fa-lg "></i></span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Shiping Address</span> <div style="width: 75%"><?php echo  ucwords($row['address']); ?></div> </div>
                                    </td>
                                </tr>
								<?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
								<?php 
								
									$list2 = $conn->query("SELECT * FROM orders_items WHERE order_id='".$od."'");
									
									while($row2=$list2->fetch_assoc()):
									
										$list1 = $conn->query("SELECT * FROM products WHERE product_id='".$row2['product_id']."'");
								
										while($row1=$list1->fetch_assoc()):
											$protot=$row1['product_price']*$row2['quantity'];
								?>
                                <tr>
									<td width="20%"><div style="border: 2px double rgba(0,0,0,0.45)"><img src="laundry/assets/img/<?php echo $row1['product_image'] ?>" width="90" height="90"></div> </td>
                                    <td width="60%"> <span class="font-weight-bold"><?php echo $row1['product_name']; ?></span>
                                        <div class="product-qty"> <span class="d-block text-dark">Quantity:<?php echo $row2['quantity'] ?></span></div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold">₹<?php echo $protot; ?></span> </div>
                                    </td>
								</tr>
								<?php endwhile; ?>
								<?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>₹<?php echo $total; ?>.00</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>₹0.00</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>₹0.00</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="text-success">₹0.00</span> </div>
                                        </td>
                                    </tr>
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold">₹<?php echo $total; ?>.00</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>We will be sending order email when the item shipped successfully!</p>
                    <p class="font-weight-bold mb-0">Thanks for connect with us!</p> <span>LMS Team</span>
                </div>
                <div class="d-flex justify-content-between card-footer p-3"><?php echo "Created date is " . date("Y-m-d h:i:sa"); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:57%">
<div class="card" >
	<div class="card-body">
		<div class="row">
			<button type="button"  class="btn-block ml-5 mr-5 btn-primary btn-sm" id="print" onclick="javascript:printDiv('printablediv')"><i class="fas fa-print fa-lg"></i> Print</button>
			<button type="button" onclick="javascript:home()" class="btn-block ml-5 mr-5 btn-primary btn-sm"><i class="fas fa-home fa-lg"></i> Go Back to Home</button>
		</div>
	</div>
</div>
</div>
<?php unset($_SESSION['bill_id']); ?>
<style>
	.card {
    border: none
}
.logo {

    font-size: 30px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
.totals tr td {
    font-size: 13px
}

.footer {
    background-color: #eeeeeea8
}

.footer span {
    font-size: 12px
}

.product-qty span {
    font-size: 12px;
    color: #dedbdb
}
</style>
<script>
function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;
        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = divElements;
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }
function home(){
	window.location.assign('index.php?page=home');
}
</script>