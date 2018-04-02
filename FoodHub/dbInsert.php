<?php
	session_start();

	echo $_POST[ "userHandleForm" ];
	$userHandleForm = trim( $_POST[ "userHandleForm" ] );

	$user = $_SESSION["username"];

	$host = "localhost";
	$dbuser = "dbuser";
	$password = "goodbyeWorld";
	$database = "foodhub";
	$table = "displaynames";

	$db_connection = new mysqli( $host, $dbuser, $password, $database );
	if( $db_connection->connect_error ) {
		die( $db_connection->connect_error );
	}

	$query = "insert into $table values( '$user', '$userHandleForm' )";

	$result = $db_connection->query( $query );

	if( ! $result ) {
		header("Location: error.php");
	} else {
		header("Location: main.php");
	}
?>