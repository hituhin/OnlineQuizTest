<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/user.php');
	$usr = new user();
	  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	  $name = $_POST['name'];
    	  $username = $_POST['username'];
    	  $password = $_POST['password'];
    	  $email = $_POST['email'];
    	  $userregi = $usr->userRegistration($name, $username,$password,$email );
    }  
  ?>