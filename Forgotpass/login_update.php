<?php include "db.php";?>


<?php
	$msg="";
//echo "<script>alert('1');</script>";
	if(isset($_POST['submit']))
	{
		$rpass=$_POST['cpassword'];
		$pass=$_POST['newpassword'];
		//echo "<script>alert('pass ".$pass."');</script>";
		if($rpass == $pass)
		{
			global $connection;
			//echo "<script>alert('3');</script>";
			$pass=md5($pass);
			 $query ="UPDATE user SET user_password = '$pass' WHERE user_mail = '".$_SESSION['femail']."'";
			$result =mysqli_query($connection, $query);
			if($result)
				echo "<script> window.location.assign('index.php?page=login'); </script>";
		}
		else
			$msg="Wrong password";
	}
?>
<div class="container py-5">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                  <div class="flex-grow-1 bg-register-image">
					  <div class="flex-grow-1 bg-login-image">
						  <div style="border: double black; width:250px;height: 250px;margin-left: 30%;margin-top: 7%;">
							  <div class="py-5 px-5 ml-4 mt-3">
								  <i class="fas fa-user fa-7x text-dark"></i>
							  </div>
						  </div>
					  </div>
                </div>
				</div>
              <div class="col-lg-7">
                <div class="p-5">
					<?php if(!strcmp($msg,"Wrong password")):  ?>
					 <div class="alert alert-danger text-center">
    					<strong>Worng Password</strong>
  					</div>
					<?php endif; ?>
                        <form action="" method="post">
                            <div class="form-group row">
                                <div class="col-sm-8 mb-5 mb-sm-1"><input class="form-control form-control-user" type="email" describedby="emailHelp" id="exampleFirstName" placeholder="<?php echo $_SESSION['femail']; ?>" name="username" required value="<?php echo $_SESSION['femail']; ?>" /></div>
							</div>
							<div class="form-group row">
                                <div class="col-sm-8 mb-5 mb-sm-1"><input class="form-control form-control-user" type="password" id="examplelastName" placeholder="Password" name="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required /></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8 mb-5 mb-sm-1"><input class="form-control form-control-user" type="password" id="exampleInputEmail" aria- placeholder="Re-Enter Password"  name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/></div>
							</div>
							<div class="ml-5 px-5">
								<div class="ml-2">
                            	<button class="btn btn-primary text-white btn-user" type="submit" name="submit">Save Password</button>
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>