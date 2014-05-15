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
//include "./userauth.php3";
include "../functions.php";
include "./rates_functions.php";

$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );

if( $act == "add" || $act=="delete" ){
	include "../check_date.php3";
//	include "../check_rooms.php3";
	if( $act == 'add' && !($singles && $doubles && $triples && $executives ) ) {
		header("Location: $HTTP_REFERER");
		exit;			
	}
	$query = "LOCK TABLES Rates WRITE";
	mysql_query( $query ) or die("$query<br> ".mysql_error());
	
	for( $date = $start_date; $date <= $end_date; $date = inc_date( $date,1 ) ) {
		$query = "DELETE FROM Rates
			WHERE date=$date AND special_desc_id=0 AND corporate_id=0";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		if( $act != 'delete'){			
			$query = "INSERT INTO Rates( date, singles, twins, doubles, triples, executives )
				values ( '$date', '$singles', '$twins', '$doubles', '$triples', '$executives' )";
			mysql_query( $query ) or die("$query<br> ".mysql_error());
		}
		if( $warn_counter++ > 366*3 ) die("Loop bug!<br>\n");
	}

	$query = "UNLOCK TABLES";
	mysql_query( $query ) or die("$query<br> ".mysql_error());

	oplog( "Set/delete public rates from $start_day/$start_month/$start_year to $end_day/$end_month/$end_year to $singles/$twins/$doubles/$triples/$executives" );
	
	header("Location: $PHP_SELF?");
	exit;
}
?>
<? include("../header.html"); ?>
<form>
	<input type="button" value="Back" onClick="document.location='index.php3';">
</form>
<? include( "rates_msg_warn.html" ); ?>
<? include "./rates_common_date.php3"; ?>

<input type="radio" name="act" value="add" CHECKED>Add&nbsp;&nbsp;
<input type="radio" name="act" value="delete">Delete<br>

<? include "./rates_common_date_fin.php3"; ?>
<hr>
<?
$res = mysql_query( "SELECT * FROM Rates WHERE corporate_id=0 AND special_desc_id=0  ORDER BY date" )
	 or die("SELECT: ".mysql_error());
?>
<table border=1 cellpadding=2>
<tr>
	<th>Date</th>
	<th>Single</th>
	<th>Twin</th>
	<th>Double</th>
	<th>Triple</th>
	<th>Executive</th>
</tr>
<?
	while( $row = mysql_fetch_array( $res ) ) {
	  print "<tr align='right'>
		<td>".local_date($row['date'])."</td>
		<td>".$row['singles']."</td>
		<td>".$row['twins']."</td>
		<td>".$row['doubles']."</td>
		<td>".$row['triples']."</td>
		<td>".$row['executives']."</td>
		</tr>\n";
	}
?>
</table>

<? include( "copyright.html" ); ?>
