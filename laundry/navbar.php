
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
			
				
				<?php 
				if($_SESSION['login_type']==3):
				?>
			<a href="index.php?page=del_laundry" class="nav-item nav-laundry"><span class='icon-field'><i class="fa fa-water"></i></span> Laundry List</a>
			<a href="index.php?page=del_report" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-th-list"></i></span> Reports</a>		
			<a href="index.php?page=del_profile" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-th-list"></i></span> Proflie</a>
			<?php else : ?>
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=laundry" class="nav-item nav-laundry"><span class='icon-field'><i class="fa fa-water"></i></span> Laundry List</a>	
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Laundry Product</a>	
				<a href="index.php?page=categories2" class="nav-item nav-categories2"><span class='icon-field'><i class="fa fa-list"></i></span> Laundry Category</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=reports" class="nav-item nav-reports"><span class='icon-field'><i class="fa fa-th-list"></i></span> Reports</a>	
			<?php endif; ?>
				<a href="index.php?page=profile" class="nav-item nav-profile"><span class='icon-field'><i class="fa fa-user"></i></span> Profile</a>		
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] == 2): ?>
	<style>
		.nav-sales ,.nav-users,.nav-categories,.nav-categories2,.nav-reports{
			display: none!important;
		}
	</style>
<?php endif ?>