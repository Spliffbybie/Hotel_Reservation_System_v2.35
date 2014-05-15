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
	include "themes/header.php"

?>
                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_ROOM_INVENTORY ?></B></FONT></td>
		<tr><td class=WIN>


<BR><BR>
<TABLE BORDER="1" ALIGN="CENTER">
     	<th>Room Type</th>
	<th>Room Inventory</th>
	<th>On/Off</th>
	
	<? 
	if ($on==1)
	{
		echo TEXT_WARNING;
		oplog("Edit numbers of room");
		$i=1;
		while ($i<10)
		{	
			$res=mysql_query("UPDATE Roomtypes SET flag='$id[$i]' where id='$i'");		
			if (!$res) 
			  echo "Ошибка базы данных. :", mysql_error(); 
			$i++;
		}
		$on=0;
		?>
		<script language="JavaScript">
		 //document.location='inventory.php';
		</script>
		<?
		  

	} ?> 	
	
	<form name="rooms" action="inventory.php?on=1" method="post">
	<? $res = mysql_query("SELECT * FROM Roomtypes");
	$i=1;
 	while( $row = mysql_fetch_array( $res ) ) 
		{
			$id[$i]=$row['flag'];

		
		
		echo '<TR ALIGN="LEFT">';
		echo '<TD>',type($row['id']) ,'</TD>';
		echo "<TD><a href=inventedit.php?room=$i>", TEXT_ROOM_INVENTORY, '</a>';
		echo "<TD><input name='id[$i]' type=checkbox  values=$id[$i] "; 
		if ($id[$i]=='on') print 'CHECKED >';
		echo "</TD>";
		echo "</TR>";
		$i++;
		} ?>
	
		<TR>
		<TD COLSPAN=3 ALIGN="CENTER"><BR><input type=submit value="Submit">
		</TD></TR>
		</form>	
		
	
	</TR>
	</TABLE>

	<? 
	 if ($room>0 & $edit==1)
        {	
		oplog("Edit inventory rooms");
		$res=mysql_query("UPDATE Roomtypes SET inventory='$content' where id='$room'");
		if (!$res)
			echo mysql_error();	
	}

?>

<? include "themes/footer.php" ?>
