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




$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );


if( $act == "add" ){
	include "../check_date.php";
	include "../check_rooms.php";
	special_insert( $start_date, $end_date, $singles, $twins, $doubles, $triples, $executives, $RType6, $RType7, $RType8, $RType9, $RType10, $text );
	header("Location: $PHP_SELF?");
	exit;
}elseif( $act == "delete" ){
	special_delete( $spec_id );
	header("Location: $PHP_SELF?");
	exit;
}elseif( $act == "update" ){
	include "../check_date.php";
	include "../check_rooms.php";
	special_delete( $spec_id );
	special_insert( $start_date, $end_date, $singles, $twins, $doubles, $triples, $executives, $RType6, $RType7, $RType8, $RType9, $RType10, $text );
	header("Location: $PHP_SELF?");
	exit;
}

include "themes/header.php";
?>

  <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_ADD_SPECIAL_OFFER ?></B></FONT></td>
		<tr><td class=WIN>


<script language="JavaScript">
	function do_change( special_id ){
		if( document.f1.start_day.value && document.f1.end_day.value 
				&& document.f1.triples.value ) {
			if( confirm("Are you sure you want to change this rate?") ){
					document.f1.act.value = "update";
					document.f1.spec_id.value = special_id;
					document.f1.submit();
			}
		}else{
			alert("Please fill in all fields below first.");
		}
	}
	function do_delete( special_id ){
		if( confirm("Are you sure you want to DELETE this rate?") ){
			document.f1.act.value = "delete";
			document.f1.spec_id.value = special_id;
			document.f1.submit();
		}
	}
</script>

<? include( "rates_msg_warn.html" ); ?>
<? include "./rates_common_date.php"; ?>
<tr>
	<td>
		<? print TEXT_THIS_OFFER1 ?><input name="duration" value=0 size=3><? print TEXT_THIS_OFFER2 ?>
<!--		&nbsp;&nbsp;<input type=checkbox name="is_spec_new"> Use this feature.
-->
	</td>
</tr>
<tr><td><textarea name="text" cols=40 rows=5></textarea></td></tr>
<input type="hidden" name="spec_id">
<input type=hidden name="act" value="add">
<? include "./rates_common_date_fin.php"; 


$res = mysql_query( "SELECT DISTINCT * FROM Rates,Specials WHERE corporate_id=0 AND Rates.special_desc_id=Specials.special_id GROUP BY special_desc_id ORDER BY date" )
	 or die("SELECT: ".mysql_error());
?>
<table border=1 width="100%">
<tr>
	<th><? print TEXT_ARRIVAL_DATE ?></th>
	<th><? print TEXT_DEPARTURE_DATE ?></th>
	<? $i=1;
	while ($i<$k)
	{ ?>
	<th><? print type($id[$i]) ?></th>
	<? $i++; } ?>
	<th><? print TEXT_DESCRIPTION ?></th>
	<th><? print TEXT_ACTION ?></th>
</tr>

<? 	$i=1;
	while( $row = mysql_fetch_array( $res ) ) 
	{
		$query2 = "SELECT MAX(date) AS max, MIN(date) AS min FROM Rates WHERE special_desc_id=".$row['special_id'];
		$res2 = mysql_query( $query2 )  or die( "$query2<br>".mysql_error());
		$row2 = mysql_fetch_array( $res2 );
		$special[$i]=$row['special_id'] ;
		$date1[$i]=$row2['min'];
		$date2[$i]=$row2['max'];
	
		$text[$i]=$row['text'];		
		$rate[$i][1]=$row['singles'];
		$rate[$i][2]=$row['twins'];
		$rate[$i][3]=$row['doubles'];
		$rate[$i][4]=$row['triples'];
		$rate[$i][5]=$row['executives'];					
		$rate[$i][6]=$row['RType6'];	
		$rate[$i][7]=$row['RType7'];	
		$rate[$i][8]=$row['RType8'];	
		$rate[$i][9]=$row['RType9'];	
		$rate[$i][10]=$row['RType10'];	
		$i++;
	}
	$j=$i;
	$i=1;
	while ($i<$j)
	{?>
		<tr align='right'>
		<td><? print local_date($date1[$i]) ?></td>  
		<td><? print local_date($date2[$i]) ?></td>
			
		<? $m=1;
			while ($m<$k)
			{
			 echo "<td>", $rate[$i][$id[$m]], "</td>";
			 $m++;
			} ?>
		<td><? print ($text[$i]) ?></td>
		<td>
		<? print  "<a href=\"javascript:do_change('$special[$i]')\">Replace</a>
			  <a href=\"javascript:do_delete('$special[$i]')\">Delete</a>"; ?>
		</td>
		</tr>
		<? $i++;		
	}
		
	
	function special_delete( $spec_id ) {
		$query = "LOCK TABLES Rates WRITE, Specials WRITE";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
	
		$query = "DELETE FROM Rates	WHERE special_desc_id=$spec_id AND corporate_id=0";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
	
		$query = "DELETE FROM Specials	WHERE special_id=$spec_id";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
	
		$query = "UNLOCK TABLES";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		oplog("Delete special rate $spec_id");
	}

	function special_insert( $start_date, $end_date, $singles, $twins, $doubles, $triples, $executives, $RType6, $RType7, $RType8, $RType9, $RType10, $text ){
		global $duration, $is_spec_new;
		$query = "LOCK TABLES Rates WRITE, Specials WRITE";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		$query = "INSERT INTO Specials ( text, length ) values ( '$text', '$duration' )";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		$special_id = mysql_insert_id( );
	
		for( $date = $start_date; $date <= $end_date; $date = inc_date( $date,1 ) ) {
			$query="INSERT INTO Rates ( date, singles, twins, doubles, triples, executives, RType6, RType7, RType8, RType9, RType10, special_desc_id )
				values ( '$date', '$singles', '$twins', '$doubles', '$triples', '$executives', '$RType6', '$RType7', '$RType8', '$RType9', '$RType10','$special_id'  )";
			$res=mysql_query( $query ) or die("$query<br> ".mysql_error());
			if( $warn_counter++ > 366*3 ) die("Loop bug!<br>\n");
			if (!res)
				echo mysql_error();
		}

		$query = "UNLOCK TABLES";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		oplog( "Add new special rate($special_id) from $start_day/$start_month/$start_year to $end_day/$end_month/$end_year to $singles/$twins/$doubles/$triples/$executives" );
	}
?>

</table>           
	
<? include "themes/footer.php" ?>



