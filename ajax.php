<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
$_SESSION['login1_id']=1;
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'signup1'){
	$save = $crud->signup1();
	if($save)
		echo $save;
}
if($action == 'resend'){
	$save = $crud->resend();
	if($save)
		echo $save;
}
if($action == "save_laundry"){
	$save = $crud->save_laundry();
	if($save)
		echo $save;
}
if($action == "delete_laundry"){
	$save = $crud->delete_laundry();
	if($save)
		echo $save;
}




