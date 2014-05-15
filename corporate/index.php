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

?>

<tr><td valign=top>

<?
  include "themes/menu.php";
?>
</td>
<td valign=top>

<table width="100%" height="100%">
	<TR ALIGN="CENTER" VALIGN="TOP">
                <TD ALIGN="LEFT">
<?		
if ($error==1)
   print TEXT_ERROR_ROOM;
if ($error==2)
   print TEXT_ERROR_DATA;
if ($error==3)                     	
   print TEXT_NO_FREE_ROOMS;	  
if ($error==4)                     	
   print TEXT_ERROR_INPUT_ROOMS;	  

?>
			<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=5 COLOR="#cc9900">
			<BR><B><? print TEXT_HELLO ?><?echo $corp_name;?><br>
			</FONT>

			<table BORDER="0" WIDTH="600" CELLPADDING="0" CELLSPACING="0" ALIGN="CENTER" VALIGN="MIDDLE">
			<TR ALIGN="CENTER" VALIGN="TOP">
				<TD>

<? $res = mysql_query("SELECT * FROM Roomtypes where flag='on'");
		$i=1;
		while( $row = mysql_fetch_array( $res ) ) 
		{
                 $id[$i]=$row['id']; 
		 $adult[$id[$i]]=$row['adult'];
 		 $child[$id[$i]]=$row['child'];
 		 $name[$id[$i]]=$row['name'];
		 $i++;  
		}
$k=$i;
$d=mktime();
$d=date("Y-m-d",$d);

$res2 = mysql_query( "SELECT * FROM Rates WHERE corporate_id=0 AND special_desc_id=0 AND date='$d';")
	 or die("SELECT: ".mysql_error());
			while( $row = mysql_fetch_array( $res2 ) ) {
				$rate[1]=$row['singles'];
				$rate[2]=$row['twins'];
				$rate[3]=$row['doubles'];
				$rate[4]=$row['triples'];
				$rate[5]=$row['executives'];					
				$rate[6]=$row['RType6'];	
				$rate[7]=$row['RType7'];	
				$rate[8]=$row['RType8'];	
				$rate[9]=$row['RType9'];	
				$rate[10]=$row['RType10'];	
				$r=$row['date'];				
			}

?>

<script language="JavaScript">
function openBrWindow(myUrl) {
	myWin= open(myUrl, "Inventory", 
    "width=450,height=400,status=no,toolbar=no,menubar=no, location=no");
}


</script>


	

<table width="100%" height="100%">
	<TR ALIGN="CENTER" VALIGN="TOP">
		<TD>
			<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=5 COLOR="#cc9900">
			<BR><B><? print TEXT_CHECK_AVAILABILITY ?></B><p>
			</FONT>

			<table BORDER="0" WIDTH="600" CELLPADDING="0" CELLSPACING="0" ALIGN="CENTER" VALIGN="MIDDLE">
			<TR ALIGN="CENTER" VALIGN="TOP">
				<TD>
<form name="f1" action="rooms.php" method="post">
<table border=0 align="center">

	<tr align="center">
		<TD></TD>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="2"  ><? print TEXT_DD ?></FONT></TD>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="2"  ><? print TEXT_MM ?></FONT></TD>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="2"  ><? print TEXT_YYYY ?></FONT></TD>
	</tr>
	<tr align="center">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_ARRIVAL_DATE ?></B></FONT></TD>
		<td><input name="start_day"  size=3 maxlength=2></td>
		<td><input name="start_month"  size=3 maxlength=2></td>
		<td><input name="start_year"  size=5 maxlength=4></td>
	</tr>
	<tr align="center">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_DEPARTURE_DATE ?></B></FONT></TD>
		<TD><INPUT NAME="end_day" SIZE="3" MAXLENGTH="2"></TD>
		<TD><INPUT NAME="end_month" SIZE="3" MAXLENGTH="2"></TD>
		<TD><INPUT NAME="end_year" SIZE="5" MAXLENGTH="4"></TD>
	</tr>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT" COLSPAN="4"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="3"  ><? print TEXT_USE_CALENDAR ?></FONT>
		</TD>
	</TR>
</table>

<BR>
<HR WIDTH="200" COLOR="RED">
<BR>
<table BORDER="0" ALIGN="CENTER">
	<TR ALIGN="CENTER">
		<TD></TD>
		 <? $i=1;
		    while ($i<$k)
  	          {?>
		  <TD><FONT FACE=Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="3"  ><a href=invent.php    onClick="openBrWindow('invent.php?room=<? print $id[$i] ?>'); return false;"><?  print type($id[$i]) ?> </FONT></A></TD>
		  <? $i++; }?>
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_RATE_TODAY ?></B></FONT><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="3"  ><BR><CENTER>(<? print $d ?>)</CENTER></FONT></TD>
		 <? $i=1;
		    while ($i<$k)
  	          {?>
		<TD><?echo $currency_euro;?><?echo to_euro($rate[$id[$i]]) ?></TD>	
		<? $i++; }?>
		
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_ROOM_QUANTITY ?></B></FONT></TD>
		 <? $i=1;
		    while ($i<$k)
  	         {?>
		<TD><INPUT NAME="<? print $name[$id[$i]] ?>" VALUE="0" SIZE="2" MAXLENGTH="1"></TD>
		<? $i++; }?>
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_MAX_OCCUPANCY ?></B></FONT></TD>
		<? $i=1;
		    while ($i<$k)
		{if ($id[$i]==5)
		   { echo "<TD><SELECT NAME='exec_guest_number'><OPTION SELECTED>1<OPTION>2<OPTION>3</SELECT></TD>";}
        	else {
		?>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE="4"  ><B><? echo $adult[$id[$i]],"+",$child[$id[$i]]; ?></B></FONT></TD>
		<? } $i++; } ?>
		
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_CHILD ?></B></FONT></TD>
		<TD><INPUT  NAME="number_of_child"VALUE="0" SIZE="2" MAXLENGTH="1"></TD>
		
	</TR>
</table>

<BR>
<HR WIDTH="200" COLOR="RED">
<BR>
<input type=hidden name="num" value="<?echo $k;?>">
<input type=submit value="<? print TEXT_CHECK_AVAILABIL ?>">
</form>
</TD>
<TD>
<?
		include "../calendar_std.php";
		include "../calendar.php";
?>
</TD>
</TR>
</table>


</td><tr></table>
</td><tr></table>
</td></tr>
<?  include "themes/footer.php"; ?>
