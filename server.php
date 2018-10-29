<?php include('../database.php'); ?>

<?php
   session_start();
   
   $username = "";
   $email = "";
   $errors = array();
   $users = array();
   
   //if( $conn ) {
   //    echo "Connection established.<br />";
   //}else{
   //  echo "Connection could not be established.";
   //  die( print_r( sqlsrv_errors(), true));
   //}
   
   // Register user 
   
   if(isset($_POST['register'])) {
	 $username = $_POST['username'];
	 $email = $_POST['email'];
	 $password_1 = $_POST['password_1'];
	 $password_2 = $_POST['password_2'];
	 
     if (empty($username)) {
		array_push($errors, 'User name is required');
	 }
     if (empty($email)) {
		array_push($errors, 'Email is required');
	 }
     if (empty($password_1)) {
		array_push($errors, 'Password is required');
	 }
     if ($password_1 != $password_2) {
		array_push($errors, 'The passwords do not match');
	 }
   
     if (count($errors) == 0) {
	   $password = md5($password_1);
	   
	   $sql = "INSERT INTO Appusers (username,email,password) VALUES ('$username','$email','$password')";
       $stmt = sqlsrv_query( $conn, $sql );
       if( $stmt === false) {
         die( print_r( sqlsrv_errors(), true) );
       }
	   $_SESSION['username'] = $username;
	   $_SESSION['success'] = "You are now logged in";
	   header('location: index.php');
	   
	 }
	} 
	
	// Login from Login Page
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$numrows = 0;
		
	    if (empty($username)) {
			array_push($errors, 'User name is required');
		}
		if (empty($password)) {
			array_push($errors, 'Password is required');
		}
		if (count($errors) == 0) {
			$password = md5($password);
			$sql = "SELECT * FROM Appusers WHERE username = '$username' AND password = '$password'";
			$stmt = sqlsrv_query( $conn, $sql );
			if( $stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
			}
			if (sqlsrv_num_rows($stmt) == 1) {
			   echo "NumRows";
			}
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {			
				$numrows = $numrows + 1;
		    }
			
		}
		
		if ($numrows == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in" . "rows " . sqlsrv_num_rows($stmt);
			header('location: index.php');
		} else{
			array_push($errors, 'Invalid username/password combination'); }
	}
	
	// Logout
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
	}
?>