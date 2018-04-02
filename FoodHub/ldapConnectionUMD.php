<?php

// This code is from Nelson's lectures.

/* You need to update http.conf file so the ldap module is loaded */
/* Entry in http.conf: LoadModule ldap_module modules/mod_ldap.so */

$login_nm = $_POST["directoryid"];
$login_passwd = $_POST["password"];

/* Establish a connection to the LDAP server */
$ldapconn=ldap_connect("ldap://ldap.umd.edu/",389) or die('Could not connect<br>');
// $ldapconn=ldap_connect("ldaps://ldap.umd.edu/",389) or die('Could not connect<br>');

/* Set the protocol version to 3 (unless set to 3 by default) */
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

/* Bind user to LDAP with password */
$verify_user=ldap_bind($ldapconn,"uid=$login_nm,ou=people,dc=umd,dc=edu",$login_passwd);

/* Returns 1 on Success */
if ($verify_user != 1) {
  /* Failed */
  echo "Invalid directoryId/password<br>";
} else {
  /* Success */
  session_start();

  $_SESSION["loggedIn"] = true;
  $_SESSION["username"] = $login_nm;

  $host = "localhost";
	$dbuser = "dbuser";
	$password = "goodbyeWorld";
	$database = "foodhub";
	$table = "displaynames";

	$db_connection = new mysqli( $host, $dbuser, $password, $database );
	if( $db_connection->connect_error ) {
		die( $db_connection->connect_error );
	}

	$query = "select * from $table where USERNAME = '$login_nm';";

	$result = $db_connection->query( $query );

	if( ! $result ) {
		die( "Retrieval failed: ". $db_connection->error );
  } else {
  	$num_rows = $result->num_rows;
  	$row = $result->fetch_array( MYSQLI_ASSOC );

  	if( $num_rows == 0 ) {
  		header( "Location: createProfile.php" );
  	} else {
  		header("Location: main.php");
  	}
	}

	/* Freeing memory */
  $result->close();
  
  /* Closing connection */
  $db_connection->close();  
}

// Release connection
ldap_unbind($ldapconn);
?>