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
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "./header.php"
?> 

<tr><td valign=top>

<? 

include "./menu.php"  ;
include "../functions.php";

?>

</td>

<td valign=top>
<table cellSpacing=10 width=100% border=0>
<tr><td>

<?


$start_date = make_date( $start_year,$start_month,$start_day);
$end_date = make_date( $end_year,$end_month,$end_day);

$query = "SELECT * FROM Messages LEFT JOIN Operators USING(operator_id)";
if( $start_day and $end_day ){
		include "../check_date.php";
		$query .= " WHERE time<=$end_date+1 AND time>=$start_date";
}
   $res = mysql_query( $query )
		or die("$query<br>".mysql_error());
	
	include "../calendar_std.php";
?>
<script language="JavaScript">
function zoom_number(){
	id = prompt("Enter operator's name:", '');
	if(id == null || id == '') return false;
	document.location="reservations_zoom.php?id="+id;
}
</script>
<FONT size=5 color=#cc9900>&nbsp;<B><? print TEXT_LOGS ?></B></FONT>
	

<table width="100%"><tr valign="top"><td>
<h3><? print TEXT_FILTER_SETTINGS ?></h3>
<form name="f1" action="<?echo $PHP_SELF;?>" method="get">
<table>
	<tr>
        <td><? print TEXT_START_DATE ?></td>
		<td>	
			<input name="start_year" size=5 maxlength=4 value="">
			<input name="start_month" size=3 maxlength=2 value="">
			<input name="start_day" size=3 maxlength=2 value="" >
		</td>
	</tr>
	<tr>
          <td><? print TEXT_END_DATE?></td>
		<td>	
			<input name="end_year" size=5 maxlength=4 value="">
			<input name="end_month" size=3 maxlength=2 value="" >
			<input name="end_day" size=3 maxlength=2 value="" >
		</td>
	</tr>
	</table>
<input type="submit" value="<? print TEXT_FILTER?>">
</form>
</td>
<td><? include "../calendar.php"; ?></td>
</table>

<form>
  <input type="button" value="Back" onClick="document.location='index.php';">
  <input type="button" value="Show by operator's username" onClick="zoom_number();">
</form>
<table border=1>
<tr>
	<th>ID</th>
	<th><? print TEXT_USERNAME ?></th>
	<th><? print TEXT_NAME ?></th>
    	<th><? print TEXT_TIME ?></th>
    	<th><? print TEXT_ACTION ?></th>
</tr>
<?	while( $row = mysql_fetch_array( $res ) )  {	?>
<tr>
	<td><?echo $row['id'];?></td>
    <td><?echo $row['username'];?></td>
	<td><?echo $row['name'];?></td>
	<td><?echo $row['time'];?></td>
	<td><?echo $row['action'];?></td>
</tr>
<?	}					?>
</table>

</td><tr></table>
</td></tr>
<? include "footer.php" ?>

