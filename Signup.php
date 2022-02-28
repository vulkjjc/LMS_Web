<?php
?>
<div class="container py-5">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                  <div class="flex-grow-1 bg-register-image"><div class="flex-grow-1 bg-login-image"><div style="border: double black; width:250px;height: 250px;margin-left: 30%;margin-top: 25%;"><div class="py-5 px-5 ml-4 mt-3"><i class="fas fa-user fa-7x text-dark"></i></div></div></div>
                </div>
</div>
              <div class="col-lg-7">
                <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Create an Account!</h4>
                        </div>
                        <form action="" id="manage-user" class="user">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="First Name" name="first_name" required /></div>
                                <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="examplelastName" placeholder="Last Name" name="last_name" required /></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" required /></div>
                                <div class="col-sm-6"><input class="form-control form-control-user" type="tel" id="phone" name="phone" placeholder="Phone Number"  pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" required /></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
									<input class="form-control form-control-user" type="password" id="Password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input class="form-control form-control-user" type="password" id="Password2" placeholder="Repeat Password" name="repassword"  required />
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0 mt-3">
								<button type="button" class="btn" onClick="myFunction()"><i class="fa fa-eye-slash"  aria-hidden="true"></i> Show Password</button>
								</div>
								
							</div>
								
							
								<button class="btn btn-primary btn-block text-white btn-user" type="submit" name="reg">Register Account</button>
                            <hr /><a class="btn btn-danger btn-block text-white btn-google btn-user" role="button" href="index.php?page=Login">Already have an account? Login!</a>
                            <hr/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#manage-user').submit(function(e){
e.preventDefault()
$('#manage-user button[type="submit"]').attr('disabled',true).html('sign up in...');
if($(this).find('.alert-danger').length > 0 )
$(this).find('.alert-danger').remove();
$.ajax({
url:'ajax.php?action=signup',
method:'POST',
data:$(this).serialize(),
error:err=>{
console.log(err)
$('#manage-user button[type="button"]').removeAttr('disabled').html('Signup');

},
success:function(resp){
alert(resp);
if(resp == 1){
location.href ='index.php?page=otp';
}else if(resp == 3){
$('#manage-user').prepend('<div class="alert alert-danger">Recheck Password...</div>')
$('#manage-user button[type="button"]').removeAttr('disabled').html('Sigup');
}else if(resp==2){
$('#manage-user').prepend('<div class="alert alert-danger">Phone No. or Email id is already use.</div>')
$('#manage-user button[type="button"]').removeAttr('disabled').html('Sigup');
}
else{
$('#manage-user').prepend('<div class="alert alert-danger">somthing.</div>')
$('#manage-user button[type="button"]').removeAttr('disabled').html('Sigup');
}
}
})
})
function myFunction() {
	//alert('ok');
  var x = document.getElementById("Password");
  var y = document.getElementById("Password2");
  if (x.type === "password" && y.type === "password") {
    x.type = "text";
	y.type = "text";
  } else {
    x.type = "password";
	y.type = "password";
  }
}
</script>