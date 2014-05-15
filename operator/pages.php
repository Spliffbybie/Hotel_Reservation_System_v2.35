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
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "./header.php" ;

?> 
	<script language="JavaScript">
	function openBrWindow(myUrl) {
		myWin= open(myUrl, "VisualEditor", 
		"width=750,height=500,status=no,toolbar=no,menubar=no, location=no");
    		
		}
	</script>	

<tr><td>

<? include "./menu.php"  ?>

</td>

<td valign=top>
<table cellSpacing=10 width=100% border=0>
<tr>
<td align=left><font size=5 color=#cc9900><b><? print TEXT_PAGES ?></b></font><br><br></td>
</tr>
<tr><td align=left>
<?
mysql_query( "LOCK TABLE Information WRITE" ); 

if ($act=='update')
{
 $res=mysql_query("UPDATE Information SET title='$title', name='$namemenu', body='$content' WHERE info_id=$id"); 	
 if(!$res)
	echo mysql_error();	
 	
 $act=" ";	
 oplog("Update page $namemenu, $op_name"); 	
}

if ($act=='new')
{
$res=mysql_query("INSERT INTO Information SET title='$title', name='$namemenu', body='$content'"); 	
 if(!$res)
	echo mysql_error();	
 $act=" ";	
 oplog("New page $namemenu, $op_name");	

}
mysql_query( "UNLOCK TABLE" ); 


if ($act==1 AND $file>0)		
{
	 mysql_query( "LOCK TABLE Information WRITE" ); 	
	 mysql_query("DELETE FROM Information where info_id='$file'");
	 mysql_query( "UNLOCK TABLE" ); 
   	 $act=" ";		
}

if($file>0 AND !$act)
{
	$res=mysql_query("SELECT * FROM Information where info_id='$file'");
	while( $row = mysql_fetch_array( $res ) ) 
  	  {
	  ?>	
		<table width=100%>
		<form name="adminForm"  action="pages.php" method="post">
                <tr><td>Page Title</td><td>Page Name</td></tr>
		<tr><td><input name="title" size=45 value="<? print $row['title'] ?>"></td><td><input name="namemenu" value="<? print $row['name'] ?>"></td></tr>
		<tr><td colspan=2>Page Text</td></tr>
	        <tr><td colspan=2><textarea name="content" cols=60 rows=10><? print $row['body']?></textarea></td></tr>
		<tr><td colspan=2 align=right><a href=../editor.htm  onClick="openBrWindow('../editor.htm'); return false";><? print TEXT_VISUAL_EDITOR ?></a></td></tr>
		<tr><td colspan=2><input type=submit value="Sumnit"></td></tr>		
		<input type=hidden name=act value="update">
		<input type=hidden name=id value="<? print $row['info_id'] ?>">
		</form>
		</table>
	  <?
 	 }
}
if($act==1 AND $file==0)
{
        ?>
		<table width=100%>
		<form name="adminForm"  action="pages.php?" method="post">
                <tr><td>Page Title</td><td>Page Name</td></tr>
		<tr><td><input name=title size=45 value=""></td><td><input name=namemenu value=""></td></tr>
		<tr><td colspan=2>Page Text</td></tr>
	        <tr><td colspan=2><textarea name=content cols=60 rows=10></textarea></td></tr>
		<tr><td colspan=2 align=right><a href=../editor.htm  onClick="openBrWindow('../editor.htm'); return false";><? print TEXT_VISUAL_EDITOR ?></a></td></tr>
		<tr><td colspan=2><input type=submit value="Sumnit"></td></tr>		
		<input type=hidden name=act value="new">
		</form>
		</table>

	<?
}	

if ($act==" " OR (!$act AND !$file))
{
	$res=mysql_query("SELECT * FROM Information;");
	if ($res)
	{
	echo "<table width=100% border=0 cellpading=5 align=left>";
	echo "<th>Page Title</th><th>Page Name</th><th>",TEXT_ACTION,"</th>";
	while( $row = mysql_fetch_array( $res ) ) 
	{
	echo "<tr bgcolor=#ffcf9f><td><font size=2>", $row['title'], "</font></td><td><font size=2>", $row['name'], "</td><td><font size=2><a href=pages.php?file=", $row['info_id'],">", TEXT_EDIT, "</a></td><td><font size=2><a href=pages.php?file=", $row['info_id'],"&act=1>", TEXT_DELETE, "</a></td></tr>";  

	}
	echo "<tr><td colspan=4>&nbsp;</td></tr>";
	echo "<tr><td colspan=4 align=right><a href=pages.php?file=0&act=1>", TEXT_ADD_PAGE, ">></a></td></tr>";
	echo "</table>";
		
	}
}
?>



</td><tr></table>

</td></tr>


<? include "../footer.php" ; ?>