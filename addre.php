<script src="assets/price/cart.js"></script>
	<?php require "assets/price/core.php"; 
if(!isset($_SESSION['login1_id']))
    echo "<script> window.location.assign('index.php?page=login'); </script>"; ?>

<div class="container-fluid" style="width: 95%;margin-left: 2.5%;margin-top: 5%">
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card products">
				<div class="card-header"
   				 <h3 class="title mt-3" style="text-align: center" >Checkout</h3>
			</div>
				<?php
						$products = $_CC->cartGetAll();
    					$sub = 0; $total = 0; $que=0; ?>
					<?php
							$i=0;
      						if (count($_SESSION['cart'])>0) { foreach ($_SESSION['cart'] as $id => $qty) { $i++
					?>
    					<div class="item" align="center"><span class="price">₹<?php echo $products[$id]['product_price']." X ".$qty; ?></span>
						<h4><p class="item-name"><?= $products[$id]['product_name'] ?></p></h4>
    					</div>
					<?php }} ?>
					<div class="card-footer">
    				<h5><div class="total" align="center"><span>Total</span><span class="price"><?= "  ₹ ".$_SESSION['total'] ?></span></div></h5>
				</div>
			</div>
		</div>	
			<div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Shipping Adderss</p>
                        </div>
                        <div class="card-body">
                           <form method="post" action="">
			<div class="form-row">
             	<div class="col">
					
                	<div class="form-group"><label for="email"><strong>Email Address</strong></label><input disabled class="form-control" type="email" placeholder="<?php echo $_SESSION['login1_user_mail']; ?>" name="email" /></div>
                </div>
				<div class="col">
                	<div class="form-group"><label for="username"><strong>Phone Number</strong></label><input disabled class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_phone']; ?>" name="username" /></div>
              	</div>
             </div>
             <div class="form-row">
             	<div class="col">
                	<div class="form-group"><label for="first_name"><strong>First Name</strong></label><input disabled class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_first_name']; ?>" name="first_name" /></div>
                </div>
                <div class="col">
                	<div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input disabled class="form-control" type="text" placeholder="<?php echo $_SESSION['login1_last_name']; ?>" name="last_name" /></div>
                </div>
             </div>
             	<div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" required id="add" type="text" placeholder="ABC,Street" name="address" /></div>
                	<div class="form-row">
                    	<div class="col">
                        	<div class="form-group"><label for="city"><strong>City</strong></label>		<input disabled class="form-control" type="text" placeholder="Surat" value="Suart" name="city" /></div>
                        </div>
                        <div class="col">
                        	<div class="form-group"><label for="country"><strong>Country</strong></label><input class="form-control" type="text" placeholder="India" disabled value="India" name="country" /></div>
                        </div>
                     </div>
				</div>
						<div class="card-footer w-100" align="center">
                     		<button class="btn btn-primary btn-sm" type="submit" name="Next" style="width: 15%">Next</button>
						</div>
							<input type="hidden" name="city1" value="Surat">
							<input type="hidden" name="country1" value="India">
               </form> 
                        
                    </div>
                   
                         <?php 
								if(isset($_POST['Next']))
								{
									$_SESSION['address']=$_POST['address']." , ".$_POST['city1']." , ".$_POST['country1'];
									echo "<script> window.location.assign('index.php?page=payment'); </script>";
								}
							?>
                </div>
            </div>
        </div>		
    </div>
</div>


<style>
.rounded {
    border-radius: 1rem
}

.nav-pills .nav-link {
    color: #555
}

.nav-pills .nav-link.active {
    color: white
}

input[type="radio"] {
    margin-right: 5px
}

.bold {
    font-weight: bold
}
</style>
