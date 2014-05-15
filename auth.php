<?
	mysql_connect("localhost", "username", "password" )
		or die("connect: ".mysql_error());
	mysql_selectdb( "hrs" )
		or die("selectdb: ".mysql_error());

	$res = mysql_query("SELECT * FROM Settings");
	while( $row = mysql_fetch_array( $res ) ) {
		eval( "$".$row['name']."='".$row['text']."';" );
	}

	session_start();
	$hrs_root = "/home/www/hrs";
	include( "$hrs_root/language.php" );
?>

