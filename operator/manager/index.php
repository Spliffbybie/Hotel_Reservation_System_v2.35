<?
	include "../../auth.php";
	include "../userauth.php";
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "themes/header.php"	;

?>
			

<table>
<? include "themes/footer.php"; 

?>

