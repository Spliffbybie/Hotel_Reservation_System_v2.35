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
	include "../../functions.php";
	
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}


	if( $act == "add" ){
			$query = "INSERT INTO Operators ( username, password, details, name, can_delete )
			values ( '". addslashes($username) ."', '". addslashes($password) ."', '". addslashes($details) ."', '". addslashes($op_name) ."', '". addslashes($can_delete) ."')";
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog("Add new operator: $username, $op_name");
			header("Location: $PHP_SELF?");
	} elseif( $act == "del" ) {
			$query = "DELETE FROM Operators WHERE operator_id=".addslashes($id);
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog("Delete operator $id");
			header("Location: $PHP_SELF?");
	} elseif( $act == "change_write" ){
			$query = "UPDATE Operators SET
				username='".addslashes($username)."', 
				password='".addslashes($password)."', 
				details='".addslashes($details)."', 
				name='".addslashes($op_name)."', 
				can_delete=".($can_delete?1:0)."
				WHERE operator_id=".addslashes($id);
			
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog("Update operator's($id) properties.");
			header("Location: $PHP_SELF?");
	} elseif( $act == "change" ) {
		$res = mysql_query( "SELECT * FROM Operators WHERE operator_id=$id" )
			or die("SELECT: ".mysql_error());
		$row = mysql_fetch_array( $res );	
		
	} else {
		$res = mysql_query( "SELECT * FROM Operators ORDER BY username" )
			or die("SELECT: ".mysql_error());
	

include "themes/header.php";
?>

		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_OPERATORS ?></B></FONT></td>
		<tr><td class=WIN>



<script language="JavaScript">
	function del_corp( corp_id, corp_name ) {
		var url = "<?echo $PHP_SELF;?>?act=del&id=" + corp_id;
		if( confirm("Are you sure you want to\nDELETE operator "+corp_name + "?") )
			document.location=url;
	}


</script>

<table border=1>
<tr>
	<th>Username</th>
	<th>Name</th>
	<th>Can delete</th>
	<th>Details</th>
	<th>Manage</th>
</tr>
<?
	while( $row = mysql_fetch_array( $res ) ) {
		print "<tr>
		<td>".$row['username']."</td>
		<td>".$row['name']."</td>
		<td>".$row['can_delete']."</td>
		<td>".$row['details']."</td>
		<td><a href=\"javascript:del_corp(" .$row['operator_id'].",'".$row['name']. "');\">Delete</a>
		    <a href=\"$PHP_SELF?act=change&id=".$row['operator_id']."\">Change</a></td>
		</tr>\n";
	}
	print "</table>";
 } 


?>
<hr>
<form action="<?echo $PHP_SELF;?>" method="post">
<br>	<input name="op_name" value="<?echo $row['name'];?>"> Name
<br>	<input name="username" value="<?echo $row['username'];?>"> Username
<br>	<input name="password" value="<?echo $row['password'];?>"> Password
<br>	<input type="checkbox" name="can_delete" "<?echo ($row['can_delete']?"CHECKED":"");?>"> Can delete
<br>	Details<br><textarea name="details" rows=6 cols=40><?echo $row['details'];?></textarea>

<? if( $act=="change") {				?>
	<input type=hidden name="act" value="change_write">
	<input type=hidden name="id" value="<?echo $row['operator_id'];?>">
<? }else{						?>
	<input type=hidden name="act" value="add">
<? }							?>

<br><input type=submit value="Submit"><input type="button" value="Cancel" onClick="document.location='operators.php'">
</form>



<? include "themes/footer.php" ; ?>
