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
	include "../auth.php";
	include "./userauth.php";
	include "../functions.php";	



	if( $act == "add" ){
			$query = "INSERT INTO Corporates (type, name, address, phone, fax, contact_name, email, username, password, max_booking )
				values( '$corp_type', '$corp_name', '$address', '$phone', '$fax', '$contact_name', '$email', '$username', '$password', '$max_booking')";
			
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog("Add new corporate client: $corp_name($corp_type)");
			header("Location: $PHP_SELF?");
	} elseif( $act == "del" ) {
			$query = "DELETE FROM Corporates WHERE corporate_id=$id";
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog("Delete a corporate client number $id");
			header("Location: $PHP_SELF?");
	} elseif( $act == "change_write" ){
			$query = "UPDATE Corporates SET
				type='$corp_type', name='$corp_name',
				address='$address', phone='$phone',
				fax='$fax', contact_name='$contact_name',
				email='$email', username='$username',
				password='$password', max_booking=$max_booking WHERE corporate_id=$id";
			
			mysql_query( $query )
				or die("$query<br> ".mysql_error());
			oplog( "Update corporate client( $id ) properties to ".
					"$corp_type, $corp_name, $address. $contact_name, $email, $username, $max_booking" );
			header("Location: $PHP_SELF?");
	} elseif( $act == "change" ) {
		$res = mysql_query( "SELECT * FROM Corporates WHERE corporate_id=$id" )
			or die("SELECT: ".mysql_error());
		$row = mysql_fetch_array( $res );	
		
	} else {
		$res = mysql_query( "SELECT * FROM Corporates ORDER BY type,name" )
			or die("SELECT: ".mysql_error());

include "themes/header.php";
?>
<script language="JavaScript">
	function del_corp( corp_id, corp_name ) {
		var url = "<?echo $PHP_SELF;?>?act=del&id=" + corp_id;
		if( confirm("Are you sure you want to\nDELETE client "+corp_name + "?") )
			document.location=url;
	}


</script>
                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_CORPORATE_PARTNERS ?></B></FONT></td>
		<tr><td class=WIN>


<FONT size=5 color=#cc9900>&nbsp;<B><? print TEXT_CORPORATE_PARTNERS ?></B></FONT>
		
		


<table border=1 >
<tr>
	<th><? print TEXT_TYPE ?></th>
	<th><? print TEXT_NAME ?></th>
	<th><? print TEXT_MAX_BOOKING ?></th>
	<th><? print TEXT_ADDRESS ?></th>
	<th><? print TEXT_TEL ?></th>
	<th><? print TEXT_FAX ?></th>
	<th><? print TEXT_CONTACT_NAME ?></th>
	<th><? print TEXT_EMAIL ?></th>
	<th><? print TEXT_USERNAME ?></th>
	<th><? print TEXT_MANAGE ?></th>
</tr>
<?
	while( $row = mysql_fetch_array( $res ) ) {
		print "<tr>
		<td>".$row['type']."</td>
		<td>".$row['name']."</td>
		<td>".$row['max_booking']."</td>
		<td><pre>".$row['address']."</pre></td>
		<td>".$row['phone']."</td>
		<td>".$row['fax']."</td>
		<td>".$row['contact_name']."</td>
		<td><a href=\"mailto:".$row['email'].'">'.$row['email']."</a></td>
		<td>".$row['username']."</td>
		<td><a href=\"javascript:del_corp(" .$row['corporate_id'].",'".$row['name']. "');\">Delete</a>
		    <a href=\"$PHP_SELF?act=change&id=".$row['corporate_id']."\">Change</a>
		</td>
		</tr>\n";
	}
	print "</table>";
 } 

?>
<hr>
<form action="<?echo $PHP_SELF;?>" method="post">
	<select name="corp_type">
		<option value="corporate">Corporate
		<option value="tour">Tour operator
		<option value="airline">Airline
	</select>
<br>	<input name="corp_name" value="<?echo $row['name'];?>"><? print TEXT_NAME ?>
<br>	<input name="max_booking" size="3" value="<?echo $row['max_booking'];?>"><? print TEXT_MAX_BOOKING ?>
<br>	<? print TEXT_ADDRESS ?><br><textarea name="address" rows=6 cols=40><?echo $row['address'];?></textarea>
<br>	<input name="phone" value="<?echo $row['phone'];?>"> <? print TEXT_TEL ?>
<br>	<input name="fax" value="<?echo $row['fax'];?>"> <? print TEXT_FAX ?>
<br>	<input name="contact_name" value="<?echo $row['contact_name'];?>"> <? print TEXT_CONTACT_NAME ?> 
<br>	<input name="email" value="<?echo $row['email'];?>"> <? print TEXT_EMAIL ?>
<br>	<input name="username" value="<?echo $row['username'];?>"> <? print TEXT_USERNAME ?>
<br>	<input name="password" value="<?echo $row['password'];?>"> <? print TEXT_PASSWORD ?>

<? if( $act=="change") {				?>
	<input type=hidden name="act" value="change_write">
	<input type=hidden name="id" value="<?echo $row['corporate_id'];?>">
<? }else{						?>
	<input type=hidden name="act" value="add">
<? }							?>

<br><input type=submit value="Submit">
</form>


<? include "themes/footer.php" ?>


