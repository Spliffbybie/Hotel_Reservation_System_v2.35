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
	include "auth.php";  
	include "functions.php";       		
//	include "themes/header.php"; 
?>

<html>
<head>
    <link rel="stylesheet" title="compact" type="text/css" href="themes/main.css">
</head>

<?
	 print '<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" size="6" color="#cc9900">';
   	 print TEXT_ROOM_INVENTORY;	
		
   	 print "</FONT><P>";	
	 $res = mysql_query("SELECT * FROM Roomtypes where id='$room'");
	 print '<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" size="4" color="#cc9900">';
	 while( $row = mysql_fetch_array( $res ) ) {
         print type($room);	
	 $invent=$row['inventory'];	
	 print "</FONT><P>";		
	 print '<FONT FACE="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3>';
	 echo $invent;							
         print '</FONT>';	
	} 


?>
</body>
</html>