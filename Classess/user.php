<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

class user{

	private $db;
 	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	 	}
	 	public function userRegistration($name,$username,$password,$email ){
	 		$name = $this->fm->validation($name);
	 		$username = $this->fm->validation($username);
	 		$password = $this->fm->validation($password);
	 		$email = $this->fm->validation($email);

	 		$name =mysqli_real_escape_string ($this->db->link, $name);
	 		$username =mysqli_real_escape_string ($this->db->link, $username);
	 		$password = mysqli_real_escape_string($this->db->link, md5($password));
	 		$email =mysqli_real_escape_string ($this->db->link, $email);
	 		if ($name== "" || $username == "" || $password == "" || $email == "" ) {
	 			echo " <span class='error'><b>Fields Must not be empty</b></span> ";
	 			exit();
	 		}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
	 			echo "<span class='error'>Invalid Email Address</span> ";
	 			exit();
	 		}else{
              $chkquery = "SELECT * FROM  tbl_user WHERE email = '$email'";
              $chkresult = $this->db->select($chkquery);
              if ($chkresult!= false) {
              	echo "<span class='error'>Email Address Already Exist !</span> ";
	 			exit();
              }else{
              	$query = "INSERT INTO tbl_user(name,username,password,email) VALUES('$name','$username','$password','$email' )";
              	$inserted_row = $this->db->insert($query);
              	if ($inserted_row) {
              		 echo "<span class='success'>Registration Successful !</span> ";
	 			exit();
              	}else{
              		echo "<span class='error'>Registration Error !</span> ";
	 			exit();
              	}
              }

	 		}
	 	}
	 	public function getAllUser(){

	 		$query = "SELECT * fROM tbl_user ORDER BY userid DESC";
	 		$result = $this->db->select($query); 
	 		return $result; 
	 	}
	 	public function DisableUser($userid){
	 		$query = "UPDATE tbl_user
               SET
               status = '1'
               WHERE userid = '$userid'";
            $updated_row = $this->db->update($query); 
            if ($updated_row) {
              	$msg = "<span class='success' >User Disabled !</span>";
              	return $msg;
              }  else{
              	$msg = "<span class='error' >User Not Disabled !</span>";
              	return $msg;

              }

	 	}
	 	public function EnableUser($userid){
	 		$query = "UPDATE tbl_user
               SET
               status = '0'
               WHERE userid = '$userid'";
            $updated_row = $this->db->update($query); 
            if ($updated_row) {
              	$msg = "<span class='success' >User Ensabled !</span>";
              	return $msg;
              }  else{
              	$msg = "<span class='error' >User Not Enabled !</span>";
              	return $msg;
	 		 }
	 		}
	 	public function Delete($userid){
            $query = "DELETE FROM tbl_user WHERE userid = '$userid'";
            $deldata = $this->db->delete($query); 
            if ($deldata) {
              	$msg = "<span class='success' >User Successfuly Deleted !</span>";
              	return $msg;
              }  else{
              	$msg = "<span class='error' >Some thing is going wrong !</span>";
              	return $msg;
	 		 }

	 		}
	 	}
	 ?>



 