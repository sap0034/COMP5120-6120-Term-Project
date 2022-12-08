<!-- PHP code to establish connection with the localserver -->
<?php
// Username
$user = 'sap0034';
$password = 'Comp6320TP#$';
 
// Database name is sap0034db
$database = 'sap0034db';
 
// Server 
$servername='sysmysql8.auburn.edu';

//gets the connection to the database
function getConnection() {
global $user, $password, $database, $servername;
$con = mysqli_connect($servername, $user, $password, $database);
	if(!$con) {
		die('Could not connect: ' . mysqli_error(con));
	}
	return $con;
}

//function to execute a query and return the result
function executeQuery($con, $query) {
	$result = mysqli_query($con, $query);
	return $result;
}

//function to get the row counts
function countAffectedRows($con) {
	return mysqli_affected_rows($con);
}

//gets the errors and returns them
function getError($con) {
	return mysqli_error($con);
}
?>
