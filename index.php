<?php include('server.php'); ?>
<?php include('userpermission.php'); ?>
<?php include('getusers.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>User Reg</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
		
	</div>

	<div class="content">	
	    <?php if(isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php 
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
			</div>
		<?php endif ?>
		<?php if(isset($_SESSION["username"])): ?>
			<p> Welcome <strong><?php echo $_SESSION["username"]; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a></p>
		<?php endif ?>
	</div>
	<div class="content">
	<table width="600" border="1" cellpadding="1" cellspacing="1">
		<tr>
			<th>Id</th>
			<th>FirstName</th>
			<th>SurName</th>
			
		</tr>
			
		<?php 
			$sql = "SELECT FirstName, SurName FROM Staff";
			$stmt = sqlsrv_query( $conn, $sql );
			if( $stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
            }
			//var_dump($userssurname);
			foreach ($usersid as $staffid)
			{
			 	echo "<tr>";
				echo "<td>".$staffid."</td>";
				echo "<td class='input-table'><input class='input-table' type='text' name='firstname' value=".$usersfirstname[$staffid]."></td>";
				echo "<td class='input-group'><input class='input-group' type='text' name='surname' value=".$userssurname[$staffid]."></td>";
				//echo "<td>".$userssurname[$staffid]."</td>";
			 	echo "</tr>";
			}
			
			//while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			//	echo "<tr>";
			//	echo "<td>".$row['FirstName']."</td>";
			//	echo "<td>".$row['SurName']."</td>";
		//		echo "</td>";
			//}
		?>
		
			
	</table>
	</div>

</body>


</html>
