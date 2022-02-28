<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: whhite;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>
<nav class="navbar  navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
	<div class="container-xl"><div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
				<a href="index.php?page=home"><div class="laundry-logo"></div></a>
  			</div>
  		</div><a class="navbar-brand" href="index.php?page=home">LMS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navcol-1">
			<ul class="nav nav-pills ml-auto">
			<li><a href="index.php?page=home" class="nav-link nav-home"> Home</a></li>
<!--				<li><a href="index.php?page=order" class="nav-link nav-order"> Order</a></li>-->
				<?php //if(($_SESSION['login1_id'] != NULL)):?>
					<li><a href="index.php?page=Price" class="nav-link nav-price">Price</a></li>
				<?php //else: ?>
					<!--<li><a href="index.php?page=login" class="nav-link nav-price">Price</a></li>-->
				<?php //endif; ?>
				<!--<li><a href="index.php?page=profile" class="nav-link nav-profile">Profile</a></li>-->
				<li><a href="index.php?page=Services" class="nav-link nav-Service">Service</a></li>
				<li><a href="index.php?page=About" class="nav-link nav-about">About</a></li>				
				
				<?php if($_SESSION['login1_type'] != NULL): ?>
				
					<li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2"><?php echo $_SESSION['login1_first_name'] ?></span><i class="border rounded-circle img-profile fas fa-user fa-lg text-dark"></i></a>
                        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
							<a href="index.php?page=profile" class="dropdown-item"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</a>
							<a href="index.php?page=order" class="dropdown-item"><i class="fas fa-shopping-bag fa-sm fa-fw mr-2"></i>Cart</a>
							<a class="dropdown-item" href="ajax.php?action=logout"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
						</div>
					</div>
					</li>
				<?php else :?>
					<a href="index.php?page=login" class="nav-link nav-logs">Login/Signup</a>
				<?php endif; ?>
		</div>
	  </div> 
  </nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login1_type'] != NULL): ?>
	<style>
			.nav-logs{
			display: none;
		}
	</style>
<?php else: ?>
	<style>
			.nav-done{
			display: none;
		}
	</style>

<?php endif ?>