<?php
//session_start();
if(!isset($_SESSION['X'])){
	$_SESSION['X']=0; 
}
if(isset($_POST['save']))
{
	//echo "<script>alert('".$_SESSION['fotp']."');</script>";
    $rno=$_SESSION['fotp'];
    $urno=$_POST['otpvalue'];
  
	if(!strcmp($rno,$urno))
	{
		unset($_SESSION['X']);
		echo "<script> window.location.assign('index.php?page=Forgotpass/login_update'); </script>";
    	//For admin if he want to know who is register
	}
	else{
		$_SESSION['X']=5;
	}
}
//resend OTP
if(!isset($_SESSION['i'])){
	$_SESSION['i']=0; 
}
if(isset($_POST['resend'])){
	//echo "<script>alert('ok1');</script>";
	$_SESSION['i']+=1;
	if($_SESSION['i']==4){
		unset($_SESSION['i']);
		echo "<script> window.location.assign('index.php?page=Forgotpass/forgot'); </script>";
	}
	else{
		//echo "<script>alert('".$_SESSION['fotp']."');</script>";
		$rndno=$_SESSION['fotp'];//OTP generate
		$message = urlencode("otp number.".$rndno);
		$to=$_SESSION['email'];
		$subject = "Resend OTP-Verify Accout";
		$txt = "Welcome to LMS\n\nDear ".$_SESSION['fname']." ".$_SESSION['lname'].",\n\t kindly enter OTP for Sign-up: ".$rndno."\n\n\nThanks,\nTeam LMS";
		$headers = "From: asmanideeeped@gmail.com" . "\r\n" .
			"CC: asmanideeped@gmail.com";
		mail($to,$subject,$txt,$headers);
		$_SESSION['fotp']=$rndno;
		$message="OTP Successfully Resend to your mail...".$_SESSION['i'];
	}
}
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
				<div class="card-header text-center text-primary">
					<h5 class="mt-2">Verify Accout By Email</h5>
				</div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-password-image"><div class="flex-grow-1 bg-login-image"><div style="border: double black; width:250px;height: 250px;margin-left: 30%;margin-top: 10%;margin-bottom: 10%"><div class="py-5 px-5 ml-3 mt-3"><i class="fas fa-lock fa-7x text-dark"></i></div></div></div></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-2"></h4>
                                    <p class="mb-4"></p>
                                </div>
								<?php if($_SESSION['X']==5): ?>
								 <div class="alert alert-danger text-center">
    								<strong>Invalid OTP</strong>
  								</div>
								<?php endif; ?>
                                <form method="post" id="manage-user">
                                    <div class="form-group mb-5"><input type="text"  class="form-control form-control-user" required placeholder="Enter OTP..." name="otpvalue" /></div>
									<button class="btn btn-primary btn-block text-white btn-user" type="submit" onClick="myfn()" name="save">Submit</button>
									<button class="btn btn-primary btn-block text-white btn-user" onClick="" type="submit" name="resend">Resend OTP</button></form>
								<div class="mt-3 text-danger ml-3"><?php /*echo $_SESSION['otp']; resendotp();*/  if(isset($message)) { echo $message; } ?></div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="card-footer text-center text-primary">
					<h5 clas="mt-2">OTP Verification</h5>
				</div>
            </div>
        </div>
    </div>
</div>
<script></script>