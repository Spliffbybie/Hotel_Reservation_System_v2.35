<?
//
// RICS <info@rics.ru>
// Created on: <06-Nov-2001 15:28:37 bf>
//
// This source file is part of HRS software.
// Copyright (C) 1999-2001 RICS systems.
//
// This program is licence software; 
//  The licensee may modify or change this software program
// to suit licensee's needs, at licensee's own risk.
// The licensee may modify the source code for licensee's own use.
// However, the modified source code must not be resold or distributed. 

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  License for more details.
// RICS Ltd.,St.Chernigovskaya 8., Saint-Petersburg, Russia.tel./fax:
// +7 812 298 3611 E-mail: russia@rics.ru
//
	include "../../auth.php";
	include "../userauth.php";
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "../../functions.php";
include "../../rooms_functions.php";
include "themes/header.php";


	
	if( $act == 'change' ) {
		$query = "UPDATE Settings SET text='$value' WHERE name='$var_name'";
		mysql_query( $query ) or die( "$query<br>".mysql_error );
		header("Location: $PHP_SELF?");
	}
	
	$query = "SELECT * FROM Settings";
	$res = mysql_query( $query ) or die( "$query<br>".mysql_error());

?>
<script language="JavaScript">
	function change( var_name, old_value ) {
		new_value = prompt("Enter new value for "+var_name, '');
		if(new_value == null || new_value == '') return;
			document.location="settings.php?act=change&var_name="+var_name+"&value="+new_value;
	}
</script>

		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_SETTINGS ?></B></FONT></td>
		<tr><td class=WIN>




<table border=1>
<?	while( $row = mysql_fetch_array( $res ) ) {
?>		<tr valign="top">
			<td align="right">
				<b><?echo $row['name'];?></b><br>
				<i><?echo $row['comment'];?></i>
			</td>
			<td>
				<?echo $row['text'];?>
			</td>
			<td>
				<xmp><?echo $row['text'];?></xmp>
			</td>
			<td>
				<a href="javascript:change( '<?echo $row['name'];?>','<?echo $row['text'];?>' )">Change</a>
			</td>
		</tr>
<?	}	?>
</table>

<? include "themes/footer.php" ?>
