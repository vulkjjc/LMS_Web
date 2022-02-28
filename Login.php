<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                  <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
						 <div class="flex-grow-1 bg-login-image"><div style="border: double black; width:250px;height: 250px;margin-left: 30%;margin-top: 35%;"><div class="py-5 px-5 ml-4 mt-3"><i class="fas fa-user fa-7x text-dark"></i></div></div></div>
                        </div>
                    <div class="col-lg-6">
                      <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Welcome Back!</h4>
                                </div>
                                <form class="user" id="login-form" method="post">
                                    <div class="form-group"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required/></div>
                                  <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" required/></div>
                                    <!--<div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1" /><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                        </div>
                                    </div>-->
									<button class="btn btn-primary btn-block text-white btn-user" type="submit" name="login">Login</button>
                                    <hr/><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button" href="index.php?page=signup"> Create An Account!</a><a class="btn btn-danger btn-block text-white btn-user" role="button" href="index.php?page=Forgotpass/Forgot">  Forgot Password?</a><hr>
									<a class="btn btn-primary btn-block text-white btn-google btn-user" role="button" href="laundry/login.php"> For Admin only!</a><hr/>
						  		</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				//alert(resp);
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	