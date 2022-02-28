<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}
	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM user where user_mail = '".$email."' and user_password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login1_'.$key] = $value;
			}
			$_SESSION['login1_type']="done";
			return 1;
		}
		else{
				return 3;
		}
	}
	function login2(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM user_info where user_mail = '".$email."' and use_password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login1_'.$key] = $value;
			}
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    			$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else {
    			$ip = $_SERVER['REMOTE_ADDR'];
			}
			$this->db->query("UPDATE cart set user_id = '".$_SESSION['login1_user_id']."' where client_ip ='$ip' ");
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		$_SESSION['login1_type']="";
		header("location:index.php?page=home");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		$_SESSION['login1_type']="";
		header("location:../index.php");
	}
	
	
	
	
	function signup(){
		extract($_POST);
			$_SESSION['fname']=$first_name=$_POST['first_name'];
			$_SESSION['lname']=$last_name=$_POST['last_name']; 
			$_SESSION['email']=$user_mail=$_POST['email'];
			$_SESSION['phone']=$user_phone=$_POST['phone'];
			$_SESSION['password']=$user_password=$_POST['password'];
			$repassword=$_POST['repassword'];
			$user_id;
			if($user_password==$repassword){
				$encryp_password=md5($user_password);
				$chk=$this->db->query("SELECT * FROM user WHERE user_mail='$user_mail'");
				if( $chk->num_rows > 0){
					return 3;
				}
				$chk=$this->db->query("SELECT * FROM user WHERE phone='$user_phone'");
				if($chk->num_rows > 0){
					return 3;
				}
				else
				{
					$rndno=rand(100000, 999999);//OTP generate
					$message = urlencode("otp number.".$rndno);
					$to=$_SESSION['email'];
					$subject = "OTP-Verify Accout";
					$txt = "Welcome to LMS\n\nDear ".$_SESSION['fname']." ".$_SESSION['lname'].",\n\t kindly enter OTP for Sign-up: ".$rndno."\n\n\nThanks,\nTeam LMS";
					$headers = "From: asmanideeeped@gmail.com" . "\r\n" .
						"CC: asmanideeped@gmail.com";
					mail($to,$subject,$txt,$headers);
					$_SESSION['otp']=$rndno;
					return 1;
				}
			}
			else
				return 3;
	}
	function signup1(){
		extract($_POST);
		  $rno=$_SESSION['otp'];
    	  $urno=$_POST['otpvalue'];
  
		if(!strcmp($rno,$urno)){
    		
			$name=$_SESSION['fname'];
    		$email=$_SESSION['email'];
    		$phone=$_SESSION['phone'];
    		//For admin if he want to know who is register
    		$to=$_SESSION['email'];
    		$subject = "Welcome to LMS!";
    		$txt = "\n\n\tHi Mr/Mrs./Miss ".$_SESSION['fname']." ".$_SESSION['lname']." Welcome to lms.We're thrilled to see you here! We're confident that services will help you for Dry-cleaning & Steam Ironing services  to you.\n\nThank you!\nTeam LMS";
   			$headers = "From: asmanideeeped@gmail.com" . "\r\n" .
						"CC: asmanideeped@gmail.com";
     		mail($to,$subject,$txt,$headers);
			$pass=md5($_SESSION['password']);
    		//echo "<p>Thank you for show our Demo.</p>";
    		//header( "Location: login_update.php" );
    		//For admin if he want to know who is register
			$save=$this->db->query("INSERT INTO user VALUES('','".$_SESSION['fname']."','".$_SESSION['lname']."','".$_SESSION['email']."','".$pass."','".$_SESSION['phone']."')");
			return 1;
		}
		else
			return 4;
		/*if($user_password==$repassword){
				$save=$this->db->query("INSERT INTO user VALUES('','".$_SESSION['fname']."','".$_SESSION['lname']."','".$_SESSION['email']."','".$_SESSION['password']."','".$_SESSION['phone']."')");
				return 1;
			}
			else
				return 2;*/
	}
	function save_laundry(){
		extract($_POST);
		$cname=$_SESSION['login1_first_name']." ".$_SESSION['login1_last_name'];
		$st="0";
		$totlam=$_SESSION['total'];
		$add=$_SESSION['address'];
		$qu=$_SESSION['que'];
		$data = " customer_name = '$cname' ";
		$data .= ", Status = '$st'";
		$data .= ", total_amount = '$totlam' ";
		$data .= ", queue = '$qu'";
		$data .= ", address = '$add'";
		
		if(isset($pay)){
			$data .= ", pay_status = '1' ";
		}
		if(isset($status))
			$data .= ", status = '$status' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO laundry_list set ".$data);
			if($save){
				$id = $this->db->insert_id;
				/*foreach ($weight as $key => $value) {
					$items = " order_id = '$id' ";
					$items .= ", product_id = '$laundry_category_id[$key]' ";
					$items .= ", weight = '$weight[$key]' ";
					$items .= ", unit_price = '$unit_price[$key]' ";
					$items .= ", amount = '$amount[$key]' ";
					$save2 = $this->db->query("INSERT INTO orders_items set ".$items);*/
					$sql = "INSERT INTO `orders_items` (`order_id`, `product_id`, `quantity`) VALUES ";
					$cond = [];
      				foreach ($_SESSION['cart'] as $id=>$qty) {
        				$sql .= "(?, ?, ?),";
        				array_push($cond, $this->orderID, $id, $qty);
      				}
      					$sql = substr($sql, 0, -1) . ";";
					 $pass = $this->db->query($sql);
				}
				if($pass)
					return 1;
			}		
		else{
			$save = $this->db->query("UPDATE laundry_list set ".$data." where id=".$id);
			if($save){
				$this->db->query("DELETE FROM laundry_items where id not in (".implode(',',$item_id).") ");
				foreach ($weight as $key => $value) {
					$items = " laundry_id = '$id' ";
					$items .= ", laundry_category_id = '$laundry_category_id[$key]' ";
					$items .= ", weight = '$weight[$key]' ";
					$items .= ", unit_price = '$unit_price[$key]' ";
					$items .= ", amount = '$amount[$key]' ";
					if(empty($item_id[$key]))
						$save2 = $this->db->query("INSERT INTO laundry_items set ".$items);
					else
						$save2 = $this->db->query("UPDATE laundry_items set ".$items." where id=".$item_id[$key]);
				}
				return 1;
			}	

		}
	}

	function delete_laundry(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM laundry_list where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM laundry_items where laundry_id = ".$id);
		if($delete && $delete2)
			return 1;
	}
}