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
	include "themes/header.php";
 


	$res = mysql_query("SELECT * FROM Roomtypes");
		$i=1;
		while( $row = mysql_fetch_array( $res ) ) 
		{
                 $flag[$i]=$row['flag']; 
		 $i++;  
		}


	if( $act == "del" ) {
			if( $is_can_delete ) {
				$query = "UPDATE Bookings SET is_deleted=1 WHERE booking_id=$id";
				mysql_query( $query )
					or die("$query<br> ".mysql_error());
				oplog( "Cancel reservation $id" );
					
				header("Location: reservations.php"); 
				exit;
			}
	} 

	$res = mysql_query( "SELECT * FROM Bookings WHERE booking_id=$id" )
		or die("SELECT: ".mysql_error());
	$row = mysql_fetch_array( $res );
	if( $row['client_id'] ) {
		$res = mysql_query( "SELECT * FROM Bookings AS B,Clients AS C
						WHERE booking_id=$id AND B.client_id=C.client_id" )
			or die("SELECT2: ".mysql_error());
		$row = mysql_fetch_array( $res );
	} else {
		if(!$row['corporate_id']) { 
			print "$id: no such booking. Please check if this number is correct.<br>";
			print '<form><input type=button value="Back" onClick="history.back();"></form>';
			exit;
		}
		$query2 = "SELECT * FROM Corporates WHERE corporate_id=".$row['corporate_id'];
		$res2 = mysql_query( $query2 )
			or die("$query2<br> ".mysql_error());
		$row2 = mysql_fetch_array( $res2 );
		print "<h1>".$row2['name']."(".$row2['type'].") Booking:</h1>";
	}
	mysql_query( "UPDATE Bookings SET is_seen=1 WHERE booking_id=$id" )
		or die("MARK AS SEEN: ".mysql_error());
	oplog( "Seen booking number $id" );
	
?>
<script language="JavaScript">
	function del_corp( corp_id  ) {
		var url = "<?echo $PHP_SELF;?>?act=del&id=" + corp_id;
		if( confirm("Are you sure you want to\nDELETE booking "+ corp_id + "?") )
			document.location=url;
	}


</script>

                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FfE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>
		&nbsp;<B><? print TEXT_CHECK_RESERVATION ?></B></FONT></td>
		<tr><td class=WIN>


<table border=0 cellpadding=7>
<tr valign="top"><th align="right"><? print TEXT_BOOKING_TIME ?></th><td><?echo $row['booking_time'];?></td></tr>
<? if( $row['special_id'] ) { ?>
<tr valign="top"><th align="right"><? print TEXT_SPECIAL_ORDER ?> No:</th><td><?echo $row['special_id'];?></td></tr>
<? } ?>
<tr valign="top"><th align="right"><? print TEXT_ARRIVAL_DATE ?></th><td><?echo local_date($row['start_date']);?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_DEPARTURE_DATE ?></th><td><?echo local_date($row['end_date']);?></td></tr>

<tr valign="top"><th align="right"><? print TEXT_ROOMS ?></th><td>
  <table border=0>
   <? if($flag[1]=='on')   { ?> <tr valign="top"><td><? print TEXT_SINGLE ?></td><td> <?echo $row['singles'];?></td></tr> <? } ?>
   <? if($flag[2]=='on')   { ?> <tr valign="top"><td><? print TEXT_TWIN ?></td><td> <?echo $row['twins'];?></td></tr> <? } ?>
   <? if($flag[3]=='on')   { ?> <tr valign="top"><td><? print TEXT_DOUBLE ?></td><td> <?echo $row['doubles'];?></td></tr><? } ?>
   <? if($flag[4]=='on')   { ?> <tr valign="top"><td><? print TEXT_TRIPLE ?></td><td> <?echo $row['triples'];?></td></tr><? } ?>
   <? if($flag[5]=='on')   { ?> <tr valign="top"><td><? print TEXT_EXECUTIVE ?></td><td> <?echo $row['executives'];?></td></tr><? } ?>
   <? if($flag[6]=='on')   { ?> <tr valign="top"><td><? print RType6 ?></td><td> <?echo $row['RType6'];?></td></tr><? } ?>	
   <? if($flag[7]=='on')   { ?> <tr valign="top"><td><? print RType7 ?></td><td> <?echo $row['RType7'];?></td></tr><? } ?>
   <? if($flag[8]=='on')   { ?> <tr valign="top"><td><? print RType8 ?></td><td> <?echo $row['RType8'];?></td></tr><? } ?>
   <? if($flag[9]=='on')   { ?> <tr valign="top"><td><? print RType9 ?></td><td> <?echo $row['RType9'];?></td></tr><? } ?>
   <? if($flag[10]=='on')   { ?> <tr valign="top"><td><? print RType10 ?></td><td> <?echo $row['RType10'];?></td></tr><? } ?>	
  </table>
 </td>
</tr>
<tr valign="top"><th align="right"><? print TEXT_TOTAL_COST ?></th><td><? print $currency.$row['total_cost']."( $currency_euro".to_euro($row['total_cost'])." )";?></td></tr>
<? if( $row['client_id']) { ?>
<tr valign="top"><th align="right"><? print TEXT_NAME ?></th><td><?echo $row['title'];?> <?echo $row['first_name'];?> <?echo $row['surname'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_COMPANY ?></th><td><?echo $row['company'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_ADDRESS ?></th><td>
    <?echo $row['street_addr'];?><br>
    <?echo $row['city'];?><br>
    <?echo $row['province'];?><br>
    <?echo $row['zip'];?> <?echo $row['country'];?>
  </td>
</tr>
<tr valign="top"><th align="right"><? print TEXT_TEL ?></th><td><?echo $row['phone'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_FAX ?></th><td><?echo $row['fax'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_EMAIL ?>:</th><td><a href="mailto:<?echo $row['email'];?>"><?echo $row['email'];?></a></td></td>
<tr valign="top"><th align="right"><? print TEXT_CHILD ?></th><td><?echo $row['childs'];?></td></td>
<tr valign="top"><th align="right"><? print TEXT_PAYMENT_DETAILS ?></th><td><?echo $row['cc_info'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_CONFIRM_TYPE ?></th><td><?echo $row['confirm_type'];?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_SPECIAL_REQUESTS?></th><td><?echo $row['special_requests'];?></td></tr>
<tr valign="top"><th align="right">IP address:</th><td><?echo $row['ip'];?></td></tr>
<? } else { ?>
<tr valign="top"><th align="right"><? print TEXT_GUESTS_NAME ?></th><td><pre><?echo $row['special_requests'];?></pre></td></tr>
<? } ?>
</table>
<form>
  <input type="button" value="<? print TEXT_BACK ?>" onClick="document.location='reservations.php';">
  <input type="button" value="<? print TEXT_DEL_RESERV ?>" onClick="del_corp(<?echo $id?>);">
</form>

<? include "themes/footer.php" ?>



