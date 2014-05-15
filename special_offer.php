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


include "auth.php";
include "themes/header.php"; 

?>

<tr><td valign=top>

<?

  include "themes/menu.php";
  include "functions.php"; 	

?>

</td>

<td valign=top>

<?

  $res = mysql_query("SELECT * FROM Roomtypes where flag='on'");
		$i=1;
		while( $row = mysql_fetch_array( $res ) ) 
		{
                 $id[$i]=$row['id']; 
		 $name[$i]=$row['name'];
		 $i++;  
		}
  $k=$i;	

  $query = "SELECT DISTINCT * FROM Rates AS R, Specials AS S WHERE R.special_desc_id = S.special_id GROUP BY special_id";
  $res = mysql_query( $query )  or die( "$query<br>".mysql_error());
?>

<table width="100%" height="100%">
<tr align="center" Valign="MIDDLE">
		<td >
			<table border=0 cellpadding="0" CELLSPACING="0" align="center" Valign="MIDDLE">
			<tr align=left valign=top>
				<td class="glow2" ><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=5 color=#cc9900><B><? print TEXT_HOTEL_SPECIAL_OFFERS ?></b></font>
				</td>
			</tr>
			<tr align="center" Valign="MIDDLE"><td class="glow2"  COLSPAN="8">


<?
	$i=1;
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
		<tr align="center" valign="middle"><td class="glow2" >
		<table cellspacing=8 border=0>
		<tr>
		<td class=glow2  cospan=5><b><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=4><B><?echo $text[$i] ?></B></font></td>
		</tr>
		<tr>
		<td class=glow2  align=right nowrap><b><? print TEXT_STARTS ?></td>
		<td class=glow2 nowrap><b><? echo local_date($date1[$i]) ?></td>
		<td class="glow2" align="right" nowrap><b><? print TEXT_ENDS ?></td>
		<td class="glow2" nowrap><b><?echo local_date($date2[$i]) ?></td>
		</tr>             
		<tr align=center>
		<td></td>
		<? $m=1;
			   while ($m<$k)
  	        	  {?>
	                	<td class="glow2"><? print type($id[$m]) ?></td>
		<? $m++; } ?>
		</tr>
		<tr>
		<td class=glow2 rowspan=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rates:</td>
		<? $m=1;
			while ($m<$k)
			{
			 echo "<td class=glow2>", $currency ,$rate[$i][$id[$m]], '</td>';			 
			 $m++;
			} ?>
		</tr>
		<tr>
		<? $m=1;
			while ($m<$k)
			{
			  echo "<td class=glow2>", $currency_euro ,to_euro($rate[$i][$id[$m]]), "</td>";
			 $m++;
			} ?>
		</tr>	
		
		 <tr>
		 <td colspan=8><a class="glow2-href" href="special_offer_reserve.php?type=std&spec_id=<?echo $special[$i] ?>"><? print TEXT_MAKE_BOOKING ?></a></td>
		</tr>
		</table>
		</td></tr>
	 	<tr><td class="glow2" ><hr width="400" color="#676963"></td></tr>
		<? $i++;		
	}
		
?>      </table>
	
</td></tr>
</td><tr></table>
<? include  "themes/footer.php"; ?> 

