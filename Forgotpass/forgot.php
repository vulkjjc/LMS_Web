<?php
if(!isset($_SESSION['msg'])){
	$_SESSION['msg']="";
}
include 'db.php';
session_start();
//echo "<script>alert('ok');</script>";
//$msg="";
if(isset($_POST['btn-save']))
{
	
	$email=$_POST['email'];
	$sql = "SELECT * FROM user WHERE user_mail='$email' ";
    $result1 = mysqli_query($connection, $sql);
	$_SESSION['femail']=$_POST['email'];
	if($result1->num_rows>0)
	{
		
		//echo "<script>alert('".$_SESSION['email']."');</script>";
		$rndno=rand(100000, 999999);//OTP generate
		$message = urlencode("otp number.".$rndno);
		$to=$email;
		$subject = "OTP";
		$txt = "OTP: ".$rndno."";
		$headers = "From: asmanideeeped@gmail.com" . "\r\n" .
			"CC: asmanideeped@gmail.com";
		mail($to,$subject,$txt,$headers);
		$_SESSION['fotp']=$rndno;
		echo "<script> window.location.assign('index.php?page=Forgotpass/otp'); </script>";
	}
	else
	{
		$_SESSION['msg']="Email-Id don't exist!!";
		//echo "<script>alert('Invalid ".$_SESSION['femail']."');</script>";
	}
}
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-password-image"><div class="flex-grow-1 bg-login-image"><div style="border: double black; width:250px;height: 250px;margin-left: 30%;margin-top: 17%;"><div class="py-5 px-5 ml-3 mt-3"><i class="fas fa-key fa-7x text-dark"></i></div></div></div></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-2">Forgot Your Password?</h4>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we&#39;ll send you a link to reset your password!</p>
                                </div>
								<?php if(!strcmp($_SESSION['msg'],"Email-Id don't exist!!")):  unset($_SESSION['msg']); ?>
								<div class="alert alert-danger text-center">
    								<strong>Email-Id don't exist!!</strong>
  								</div>
								<?php endif; ?>
                                <form class="user" action="" method="post">
                                    <div class="form-group">
										<input type="email" required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" />
									</div>
										<button class="btn btn-primary btn-block text-white btn-user" name="btn-save" type="submit">Reset Password</button>
								</form>
                                <div class="text-center">
                                    <hr /><a class="small" href="index.php?page=signup">Create an Account!</a></div>
                                <div class="text-center"><a class="small" href="index.php?page=Login">Already have an account? Login!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
 ?>