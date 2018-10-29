<?php
   $usersfirstname = array();
   $userssurname = array();
   $usersid = array();
   
   // SQL Server Extension Sample Code:
   $sql = "SELECT StaffID, FirstName, SurName FROM Staff";
   $stmt = sqlsrv_query( $conn, $sql );
			if( $stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
            }
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				array_push($usersid,$row['StaffID']);
				$staffid = $row['StaffID'];
				$usersfirstname[$staffid] = $row['FirstName'];
				$userssurname[$staffid] = $row['SurName'];
				//array_push($userssurname,"$row['ID'] => $row['SurName']");
			}
?>