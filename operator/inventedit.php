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

                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_ROOM_INVENTORY ?></B></FONT></td>
		<tr><td class=WIN>


 <form>
	<input type="button" value="Back" onClick="document.location='inventory.php';">
</form>
        

       	<? $res = mysql_query("SELECT inventory FROM Roomtypes where id='$room'");
 	while( $row = mysql_fetch_array( $res ) ) {
       		print type($room);			
		$invent=$row['inventory'];			
		print "</FONT><P>";		
	       }
	       ?>
	<script language="JavaScript">
	function openBrWindow(myUrl) {
		myWin= open(myUrl, "VisualEditor", 
		"width=750,height=500,status=no,toolbar=no,menubar=no, location=no");
    		
		}
	</script>
 	<form name="adminForm" action="inventory.php?room=<? print $room ?>&edit=<? print 1 ?>" method="post">
        <TABLE BORDER="0" ALIGN="CENTER">
	<TR ALIGN="CENTER">
	<TD><? print TEXT_ROOM_INVENTORY ?></TD>
	</TR>
	<TR ALIGN="CENTER">
	<TD><TEXTAREA NAME="content" cols=50 rows=10><? print $invent ?></TEXTAREA></TD>
	</TR>
	<TR>
	<TD><A HREF=editor.htm  onClick="openBrWindow('editor.htm'); return false";><? print TEXT_VISUAL_EDITOR ?></a></TD>
	</TR>
        <TR>
	<TD COLSPAN=6 ALIGN="CENTER"><BR><input type=submit value="Submit" >
	</form>			
	</TR>	
	</TABLE>

<? include "themes/footer.php" ?>

