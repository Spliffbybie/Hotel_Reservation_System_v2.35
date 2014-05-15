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
	include "../rooms_functions.php";
	include "themes/header.php";



	
	
	$start_date = make_date( $start_year,$start_month,$start_day);
	$end_date = make_date( $end_year,$end_month,$end_day);
	
	$query = "SELECT * FROM Bookings WHERE NOT is_deleted";
	if( $start_day and $end_day ){
		if( $b_type == 'made') {
			$query .= " AND booking_time<=$end_date+1 AND booking_time>=$start_date";
		}else{
			$query .= " AND (start_date >= $start_date AND start_date <= $end_date
				OR end_date >= $start_date AND end_date <= $end_date
				OR start_date <= $start_date AND end_date >= $end_date)";
		}
		if( !$show_all ) $query .= " AND NOT is_seen";
	}else{
		if( !$show_all ) $query .= " AND NOT is_seen";
	}
	$query .= " ORDER BY special_id DESC";
	$res = mysql_query( $query ) or die("$query<br>".mysql_error());
	
	include "../calendar_std.php";




?>

<SCRIPT language=JavaScript>

function zoom_number(){
	id = prompt("Enter reservation id:", '');
	if(id == null || id == '') return false;
	document.location="reservations_zoom.php?id="+id;
}
</script>

      <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>


<table border=0 BGCOLOR=#c0c0c0>
<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>
&nbsp;<B><? print TEXT_CHECK_RESERVATION ?></B></FONT></td>
<tr><td class=WIN>
		
		
	<table width="100%">
	<tr valign="top">
	<td>
	<h3><? print TEXT_FILTER_SETTINGS ?></h3>
	<form name="f1" action="<?echo $PHP_SELF;?>" method="POST">
	<table>
	<tr>
		<td colspan=2><? print TEXT_SHOW_BOOKINGS ?> 
		    <select name="b_type">
			    <option value='made'><? print TEXT_MADE ?>				
			    <option value='reserved'><? print TEXT_RESERVED ?>
		    </select>
		</td>
	</tr>
	<tr>
		<td><? print TEXT_ARRIVAL_DATE ?></td>

		<td>	<input name="start_day" size=3 maxlength=2 value="" >
			<input name="start_month" size=3 maxlength=2 value="">
			<input name="start_year" size=5 maxlength=4 value="">
			
			
		</td>
	</tr>
	<tr>
		<td><? print TEXT_DEPARTURE_DATE ?></td>
		<td>	
			<input name="end_day" size=3 maxlength=2 value="" >
			<input name="end_month" size=3 maxlength=2 value="" >
			<input name="end_year" size=5 maxlength=4 value="">
			
			
		</td>
	</tr>
	</table>
	<input type="submit" value=<? print TEXT_FILTER ?> ><input type="checkbox" name="show_all" <?echo $show_all?"CHECKED":""; ?> ><? print TEXT_SEEN_BOOKINGS ?>
	</form>
</td>
<td>
	<? include "../calendar.php"; ?>
</td>
</tr>
</table>
<form>
  <input type="button" value=<? print TEXT_BY_NUMBER ?> onClick="zoom_number();">
</form>
<? print TEXT_RED_NUMBERS ?><br>
<? print TEXT_GRAY_NUMBERS ?>

<table border=1 cellpadding=4 width="100%">
<tr align="right">
	<th>ID</th>
	<th><? print TEXT_SPEC ?></th>
	<th><? print TEXT_CLIENT ?></th>
    <th><? print TEXT_TIME_BOOKINGS ?></th>
	<th><? print TEXT_ARRIVAL_DATE ?></th>
	<th><? print TEXT_DEPARTURE_DATE ?></th>
<!--

	<th><? print TEXT_SINGLE ?></th>
	<th><? print TEXT_TWIN ?></th>
	<th><? print TEXT_DOUBLE ?></th>
	<th><? print TEXT_TRIPLE ?></th>
	<th><? print TEXT_EXECUTIVE ?></th>
-->
    <th><? print TEXT_ACTION ?></th>
</tr>
<?	while( $row = mysql_fetch_array( $res ) )  {	?>
<tr align="right">
	<td><?echo ($row['is_seen']?'<font color="#888888">':'<font color="#FFFFFF">').$row['booking_id'];?></font></td>
	<td><?echo ( $row['special_id'] ? "Yes" : "&nbsp;" );?></td>
	<td><?echo ($row['client_id']?$row['client_id']:("<font color=red>".$row['corporate_id']."</font>"));?></td>
    <td><?echo $row['booking_time'];?></td>
	<td><?echo local_date($row['start_date']);?></td>
	<td><?echo local_date($row['end_date']);?></td>
<!--
	<td><?echo $row['singles'];?></td>
	<td><?echo $row['twices'];?></td>
	<td><?echo $row['doubles'];?></td>
	<td><?echo $row['triples'];?></td>
	<td><?echo $row['executives'];?></td>
-->
    <td><a href="reservations_zoom.php?id=<?echo $row['booking_id'];?>"><? print TEXT_VIEW ?></a></td>
</tr>
<?	}					?>
</table>
         
		

<? include "themes/footer.php" ?>

                 
		


	
			



