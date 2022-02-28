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
		$qry = $this->db->query("SELECT * FROM admin where email = '".$email."' and password = '".$password."' ");
		if(mysqli_num_rows($qry) > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			$qry = $this->db->query("SELECT * FROM delivery_info where email = '".$email."' and password = '".$password."' ");
			if(mysqli_num_rows($qry) > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['del_'.$key] = $value;
				}
				$_SESSION['login_type'] = 3;
				return 2;
			}
			else{
				return 3;
			}
		}
			
	}
	function login2(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM user_info where email = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
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
			/*$ip = isset(($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];*/
			$this->db->query("UPDATE cart set user_id = '".$_SESSION['login_user_id']."' where client_ip ='$ip' ");
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
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", phone = '$phone' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO admin set ".$data);
			}else{
				$save = $this->db->query("UPDATE admin set ".$data." where id = ".$id);
			}
		if($save){
			return 1;
		}
	}
	
	function save_del(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", phone = '$phone' ";
		$data .= ", password = '$password' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO delivery_info set ".$data);
			}else{
				$save = $this->db->query("UPDATE delivery_info set ".$data." where id = ".$id);
			}
		if($save){
			return 1;
		}
	}
	
	function delete_user(){extract($_POST);
		$delete = $this->db->query("DELETE FROM admin where id = ".$id);
		if($delete)
			return 1;}
	function delete_del(){extract($_POST);
		$delete = $this->db->query("DELETE FROM delivery_info where id = ".$id);
		if($delete)
			return 1;}
	function signup(){
		extract($_POST);
		$data = " first_name = '$first_name' ";
		$data .= ", last_name = '$last_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM user_info where email = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO user_info set ".$data);
		if($save){
			$login = $this->login2();
			return 1;
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data." where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}

			return 1;
				}
	}
	
	
	function save_category(){
		
		extract($_POST);
		if(is_null($name) || is_null($price) || is_null($Catogey)){
			return 3;
		}
		$data = " product_name = '$name' ";
		$data .= ", product_price = '$price' ";
		$data .= ", Category_id = '$Catogey'";
		//$data .= ", product_image = '".$_SESSION['login_product_img']."'";
		$D='INR/Cloth';
		$data .= ", product_description = '$D'";
		
		if(empty($id)){
			$save = $this->db->query("INSERT INTO products set ".$data);
			return 1;
		}else{
			$save1 = $this->db->query("UPDATE products set ".$data." where product_id=".$id);
			return 2;
		}
		/*if($save)
			
		if($save1)*/
			
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM products where product_id = ".$id);
		if($delete)
			return 1;
	}
	/*function save_supply(){
		extract($_POST);
		$data = " name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO supply_list set ".$data);
		}else{
			$save = $this->db->query("UPDATE supply_list set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_supply(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supply_list where id = ".$id);
		if($delete)
			return 1;
	}*/

	function save_laundry(){
		extract($_POST);
			//echo "<script>alert('ok');</script>";
		
			$save = $this->db->query("UPDATE laundry_list set status = '".$status."', del_id = '".$del_id."' where id=".$id);
			/*if($save){
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
				}*/
				return 1;
			//}	

	}

	function delete_laundry(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM laundry_list where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM laundry_items where laundry_id = ".$id);
		if($delete && $delete2)
			return 1;
	}
	/*function save_inv(){
		extract($_POST);
		$data = " supply_id = '$supply_id' ";
		$data .= ", qty = '$qty' ";
		$data .= ", stock_type = '$stock_type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO inventory set ".$data);
		}else{
			$save = $this->db->query("UPDATE inventory set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_inv(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM inventory where id = ".$id);
		if($delete)
			return 1;
	}*/
	
}
?>