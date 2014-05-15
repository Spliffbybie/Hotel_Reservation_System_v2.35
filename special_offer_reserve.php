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

include "./auth.php";
include "themes//header.php";
include "./functions.php"; 	
?>

<tr><td valign=top>

<?

  include "themes/menu.php";


?>

</td>

<td valign=top>

<?

	$res = mysql_query("SELECT * FROM Roomtypes where flag='on'");
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

		
	$res2 = mysql_query("SELECT MAX(date) AS max, MIN(date) AS min FROM Rates WHERE special_desc_id='$spec_id'");
	while( $row = mysql_fetch_array( $res2 ) ){
		$start_date=$row['min'];	
		$end_date=$row['max'];	
	}

	 

?>

<TABLE width="100%" height="100%" ALIGN=CENTER>
	<TR ALIGN="CENTER" VALIGN="MIDDLE">
		<TD>
			<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=5 COLOR="#cc9900">
			<BR><B><? print TEXT_CHECK_AVAILABILITY ?></B><P>
			</FONT>

			<TABLE BORDER="0" WIDTH="600" CELLPADDING="0" CELLSPACING="0" ALIGN="CENTER" VALIGN="MIDDLE">
			<TR ALIGN="CENTER" VALIGN="MIDDLE">
				<TD ALIGN=CENTER>


<FORM name="f1" action="rooms.php?special=1" method="post">
<TABLE BORDER=0 ALIGN=CENTER>

	<TR ALIGN="LEFT">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_ARRIVAL_DATE ?></B></FONT></TD>
		<TD ALIGN="CENTER"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print local_date($start_date) ?></B></FONT></TD>
		
	</TR>
	<tr align="center">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_DEPARTURE_DATE ?></B></FONT></TD>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print local_date($end_date) ?></B></FONT></TD>
		
	</TR>
	
</TABLE>
<BR>
<HR WIDTH="200" COLOR="RED">
<BR>
<TABLE BORDER="0" ALIGN="CENTER">
	<TR ALIGN="CENTER">
		<TD></TD>
		<? $i=1;
		while ($i<$k)
		{ ?>
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><? print type($id[$i]) ?></FONT></TD>
		<? $i++; 
		}?>
		
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_ROOM_QUANTITY ?></B></FONT></TD>
		<? $i=1;
		while ($i<$k)
		{ ?>
		<TD><INPUT NAME="<? print $name[$id[$i]] ?>" VALUE="0" SIZE="2" MAXLENGTH="1"></TD>
		<? $i++; 
		}?>
		
	</TR>
	<TR ALIGN="CENTER">
		<TD ALIGN="LEFT"><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? print TEXT_MAX_OCCUPANCY ?></B></FONT></TD>
                <? $i=1;
		while ($i<$k)
		{	
		if ($id[$i]==5)
		   { echo "<TD><SELECT NAME='exec_guest_number'><OPTION SELECTED>1<OPTION>2<OPTION>3</SELECT></TD>";}
        	else { 
		?>		
		<TD><FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" SIZE=3  ><B><? echo $adult[$id[$i]],"+",$child[$id[$i]]; ?></B></FONT></TD>
		<? } $i++; 
		 }?>
		
	</TR>
		
	
</table>

<BR>
<HR WIDTH="200" COLOR="RED">
<BR>
<input type=hidden name="spec_id" value="<?echo $spec_id;?>">
<input type=hidden name="start_date" value="<?echo $start_date;?>">
<input type=hidden name="end_date" value="<?echo $end_date;?>">
<input type=submit value="<? print TEXT_CHECK_AVAILABIL ?>">
</form>
</TD>
</TR>
</TABLE>

</td></tr>
</td><tr></table>
<? include "themes/footer.php" ; ?>
