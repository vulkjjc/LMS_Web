<?php 
if(!isset($_SESSION['i'])){
	$_SESSION['i']=0; 
}
if(isset($_POST['resend'])){
	$_SESSION['i']+=1;
	if($_SESSION['i']==4){
		$message="Recheck your email id ".$_SESSION['email'];
	}
	else if($_SESSION['i']>4){
		unset($_SESSION['i']);
		echo "<script> window.location.assign('index.php?page=signup'); </script>";
	}
	else{
		$rndno=$_SESSION['otp'];//OTP generate
		$message = urlencode("otp number.".$rndno);
		$to=$_SESSION['email'];
		$subject = "Resend OTP-Verify Accout";
		$txt = "Welcome to LMS\n\nDear ".$_SESSION['fname']." ".$_SESSION['lname'].",\n\t kindly enter OTP for Sign-up: ".$rndno."\n\n\nThanks,\nTeam LMS";
		$headers = "From: asmanideeeped@gmail.com" . "\r\n" .
			"CC: asmanideeped@gmail.com";
		mail($to,$subject,$txt,$headers);
		$_SESSION['otp']=$rndno;
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
                                <form method="post" id="manage-user">
                                    <div class="form-group mb-5"><input type="text"  class="form-control form-control-user" id="exampleInputEmail" aria-describedby="" placeholder="Enter OTP..." name="otpvalue" /></div>
									<button class="btn btn-primary btn-block text-white btn-user" type="submit" onClick="myfn().submit()" name="submit">Submit</button>
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
<?php if(isset($_POST['submit'])){
	$a=$_POST['otpvalue'];
} ?>
<script>
function myfn(){

	//alert('1');
	//document.getElementById("#manage-user").submit();
$('#manage-user').submit(function(e){
	//alert('2');
		//e.preventDefault()
		$('#manage-user button[type="button"]').attr('disabled',true).html('Checking...');
	//alert('3');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=signup1',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#manage-user button[type="button"]').removeAttr('disabled').html('Submit');

			},
			success:function(resp){
				//alert(resp);
				if(resp == 1){
					location.href ='index.php?page=login';
				}else if(resp == 2){
					$('#manage-user').prepend('<div class="alert alert-danger">Recheck OTP...</div>')
					$('#manage-user button[type="button"]').removeAttr('disabled').html('Submit');
				}else{
					$('#manage-user').prepend('<div class="alert alert-danger">Somethig Wrong....</div>')
					$('#manage-user button[type="button"]').removeAttr('disabled').html('Submit');
				}
			}
		})
	})
}
</script>