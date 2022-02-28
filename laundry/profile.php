<?php include 'db_connect.php';
?>
	 <div class="container-fluid">
		 <div style="margin-left: 50%;margin-top: 30px;"><h3 class="text-dark mb-4" >Profile</h3></div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class=" card mb-5">
                <div class="card-body text-center mb-4"><i class="fas fa-user fa-10x mb-5 mt-5 rounded-circle mb-3 mt-4"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="<?php echo $_SESSION['login_email']; ?>" name="email" /></div>
                                    </div>
									<div class="col">
                                        <div class="form-group"><label for="username"><strong>Phone Number</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['login_phone']; ?>" name="username" /></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>Name</strong></label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['login_name']; ?>" name="first_name" /></div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</div>
    </div>
</div>