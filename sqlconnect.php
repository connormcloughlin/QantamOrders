<html>
<head><title>Testing SQL</title></head>

<?php
// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "qantamdev@qantamdev", "pwd" => "Q@nt@mD#v", "Database" => "qantamdevelopment", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:qantamdev.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.";
     die( print_r( sqlsrv_errors(), true));
}

	 $sql = "SELECT FirstName, SurName FROM Staff";
     $stmt = sqlsrv_query( $conn, $sql );
     if( $stmt === false) {
      die( print_r( sqlsrv_errors(), true) );
     }
     echo "<form action='process.php' method='post'>";
     while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         echo "<input SurName='SurName' type='text' value=" . $row['SurName']." "."</input>";
         echo "<input FirstName='FirstName' type='text' value=" . $row['FirstName']." "."</input><br />";
         //echo "<input name='name' type='text'  value=" . $row['FirstName']."</input><br />";
     }
echo "</form>";
     
     sqlsrv_free_stmt( $stmt);

?>

</html>