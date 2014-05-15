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
include "./rates_functions.php";


$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );

if( $act == "add" || $act=="delete" )
{
	include "../check_date.php";
	
	$query = "LOCK TABLES Rates WRITE";
	mysql_query( $query ) or die("$query<br> ".mysql_error());
	
	if ($act=='delete')
	{
	for( $date = $start_date; $date <= $end_date; $date = inc_date( $date,1 ) ) 
		{
		$query = "DELETE FROM Rates
			WHERE date=$date AND special_desc_id=0 AND corporate_id=0";
		mysql_query( $query ) or die("$query<br> ".mysql_error());
		}
	$query = "UNLOCK TABLES";
	mysql_query( $query ) or die("$query<br> ".mysql_error());
	oplog( "Delete public rates from $start_day/$start_month/$start_year to $end_day/$end_month/$end_year" );
	}
	
	if( $act!="delete")
	{
	
	//echo $query;
	
	
	for( $date = $start_date; $date <= $end_date; $date = inc_date( $date,1 ) ) 
		{
			$res2=mysql_query("SELECT * FROM Rates WHERE date='$date' AND corporate_id=0 AND special_desc_id=0");			
			$row=mysql_fetch_array( $res2 );
			if (!$row)
			{
			
			$query = "INSERT INTO Rates( date, singles, twins, doubles, triples, executives, RType6, RType7, RType8, RType9, RType10 )
				values ( '$date', '$singles', '$twins', '$doubles', '$triples', '$executives', '$RType6', '$RType7', '$RType8', '$RType9', '$RType10')";
			$res=mysql_query( $query ) or die("$query<br> ".mysql_error());
			}
			else
			{
		$query="UPDATE	Rates SET "; 		
		$str=0;
		if ($singles>0)
		{
			$query.="singles='$singles'";
			$str=1;
		}
		if ($twins>0)
		{
			if ($str>0) $query.=",";
			$query.=" twins='$twins'";
			$str=1;			
		}
		if ($doubles>0)
		{
			if ($str>0) $query.=",";
			$query.=" doubles='$doubles'";
			$str=1;
		}
		if ($triples>0)
		{
			if ($str>0) $query.=",";
			$query.=" triples='$triples'";
			$str=1;
		}
		if ($executives>0)
		{
			if ($str>0) $query.=",";	
			$query.=" executives='$executives'";
			$str=1;
		}
		if ($RType6>0)
		{
			if ($str>0) $query.=",";	
			$query.=" RType6='$RType6'";
			$str=1;
		}
		if ($RType7>0)
		{
			if ($str>0) $query.=",";	
			$query.=" RType7='$RType7'";
			$str=1;
		}
		if ($RType8>0)
		{
			if ($str>0) $query.=",";	
			$query.=" RType8='$RType8'";
			$str=1;
		}
		if ($RType9>0)
		{
			if ($str>0) $query.=",";	
			$query.=" RType9='$RType9'";
			$str=1;
		}
		if ($RType10>0)
		{
			if ($str>0) $query.=",";	
			$query.=" RType10='$RType10'";
			$str=1; 
		}
	
                $query.=" where date='$date' AND corporate_id=0 AND special_desc_id=0";
		$res=mysql_query( $query ) or die("$query<br> ".mysql_error());
	
		}
			
		}
		if( $warn_counter++ > 366*3 ) die("Loop bug!<br>\n");
	$query = "UNLOCK TABLES";
	mysql_query( $query ) or die("$query<br> ".mysql_error());
	oplog( "Set/update public rates from $start_day/$start_month/$start_year to $end_day/$end_month/$end_year" );
	}
	   	
	header("Location: $PHP_SELF?");
	exit;
	
}

include "themes/header.php";

?>
                <TD  
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                bgColor=#FFE0AD cellpadding="0" cellspacing="0" valign=top>
		<table border=0>
		<tr>
		<td onmouseover="this.style.backgroundColor='maroon'"  onmouseout="this.style.backgroundColor='FFE0AD'">
		<a href=rates_public.php class=menu><? print TEXT_PUBLIC ?></a> 
		</td></tr>
		<td onmouseover="this.style.backgroundColor='maroon'"  onmouseout="this.style.backgroundColor='FFE0AD'">
                <a href=rates_corporate.php class=menu> <? print TEXT_PARTNERS ?></a>
		</td></tr></table>
                             
                </TD>
             
		   <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
                <table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_SET_RATES ?>: </B><? print TEXT_PUBLIC ?></FONT></td>
		<tr><td class=WIN>


<? include( "rates_msg_warn.html" ); ?>
<? include "./rates_common_date.php"; ?>

<input type="radio" name="act" value="add" CHECKED>Add&nbsp;&nbsp;
<input type="radio" name="act" value="delete">Delete<br>

<? include "./rates_common_date_fin.php"; ?>

<hr>
<?
$res = mysql_query( "SELECT * FROM Rates WHERE corporate_id=0 AND special_desc_id=0  ORDER BY date" )
	 or die("SELECT: ".mysql_error());
	$i=1;
while( $row = mysql_fetch_array( $res ) ) {
	$date[$i]=$row['date'];
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


?>
<table border=1 cellpadding=2>
<tr>
	<th><? print TEXT_DATE ?></th>
	<? $i=1;
	while ($i<$k)
	{ ?>
	<th><? print type($id[$i]) ?></th>
	<? $i++; } ?>
</tr>
<?
	
	        $i=1;
		while ($i<$j)
		{?>
		<tr align='right'>  
	        <td><? print local_date($date[$i])?></td>		
			<? $m=1;
			while ($m<$k)
			{?>
			  <td><? echo $rate[$i][$id[$m]] ?></td>
			<? $m++;} ?>
		</tr>
		<? $i++;		
		}
?>
</table>

<? include "themes/footer.php" ?>

