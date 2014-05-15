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
	include "../rooms_functions.php";
	include "../functions.php";
	include "themes/header.php"

?>
                <TD 
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_OTCHET ?></B></FONT></td>
		<tr><td class=WIN>




<table border=0>
<form name="f1" action="query.php?file=1" method="post">
<tr valign="top">
<td>
     <table>
     <tr align="right">
          <td></td><td><? print TEXT_DD ?></td><td><? print TEXT_MM ?></td><td><? print TEXT_YYYY?></td>
     </tr>
	<tr align="right">
		<td><? print TEXT_ARRIVAL_DATE ?></td>
		<td><input name="start_day" size=3 maxlength=2 value="<?echo $start_day;?>" ></td>
		<td><input name="start_month" size=3 maxlength=2 value="<?echo $start_month;?>"></td>
		<td><input name="start_year" size=5 maxlength=4 value="<?echo $start_year;?>"></td>
	</tr>
	<tr align="right">
		<td><? print TEXT_DEPARTURE_DATE ?></td>
		<td><input name="end_day" size=3 maxlength=2 value="<?echo $end_day;?>" ></td>
		<td><input name="end_month" size=3 maxlength=2 value="<?echo $end_month;?>" ></td>
		<td><input name="end_year" size=5 maxlength=4 value="<?echo $end_year;?>"></td>
	</tr>
	<tr>
			<td>
				<input type=submit value="Submit">
				</form>
			</td>
		</tr>
	</table>
</form>	
</td><td>
<?
		include "../calendar_std.php";
		include "../calendar.php";
?>
<tr><td colspan=2>
<? if ($file==1) 
{
print TEXT_SEND;
print "<br>";
$start_date =make_date($start_year,$start_month,$start_day) ;
$end_date = make_date($end_year,$end_month,$end_day);
$res = mysql_query("SELECT * FROM Bookings WHERE start_date >= '$start_date' AND start_date <= '$end_date' ORDER BY client_id");
if (!$res)
  echo mysql_error();	

//$fp = fopen ("query.txt", "wb");
$d1=local_date($start_date);
$d2=local_date($end_date);
//fwrite($fp,"Query about bookings from $d1 to $d2 ");	
$query="Query about bookings from $d1 to $d2 \n\n";
//fwrite($fp, "\n\n");
$i=1;
while( $row = mysql_fetch_array( $res ) ) 
{  	
	
	$id=$row['client_id'];
	$res2=mysql_query("SELECT * FROM Clients WHERE client_id='$id'");
	$row2 = mysql_fetch_array( $res2 );
	$query.=$row2['first_name'];	
	$query.="\t";
	$query.=$row2['surname'];		
	$query.= "\t";
	$query.= $row['start_date'];		
	$query.= "\t";
	$query.= $row['end_date'];		
	$query.= "\t";
	if ($row['singles']>0) {$query.= TEXT_SINGLE; $query.=$row['singles'];$query.= "\t";} 
	if ($row['twins']>0)  {$query.=TEXT_TWIN; $query.=$row['twins'];$query.= "\t";} 
	if ($row['doubles']>0) {$query.= TEXT_DOUBLE; $query.= $row['doubles'];$query.= "\t";} 
	if ($row['triples']>0) {$query.=TEXT_TRIPLE; $query.=$row['triples'];$query.= "\t";} 
	if ($row['executives']>0) {$query.=TEXT_EXECUTIVE; $query.=$row['executives'];$query.= "\t";} 
	if ($row['RType6']>0) {$query.= RType6; $query.=$row['RType6'];$query.= "\t";} 
	if ($row['RType7']>0)  {$query.=RType7; $query.=$row['RType7'];$query.= "\t";} 
	if ($row['RType8']>0) {$query.= RType8; $query.=$row['RType8'];$query.= "\t";} 
	if ($row['RType9']>0) {$query.= RType9; $query.=$row['RType9'];$query.= "\t";} 
	if ($row['RType10']>0) {$query.= RType10; $query.=$row['RType10'];$query.= "\t";} 
	$query.= TEXT_CHILD;
	$query.= ": ";	
	$query.= $row['childs'];		
	$query.= "\t";
	$query.= TEXT_TOTAL_COST;
	$query.= ": ";	
	$query.= $row['total_cost'];		
	$query.= "\t";
	$query.= TEXT_ADDRESS;
	$query.= " ";	
	$query.= $row2['zip'];		
	$query.= " ";
	$query.= $row2['country'];		
	$query.= " " ;
	$query.= $row2['province'];		
	$query.= " ";
	$query.= $row2['city'];		
	$query.= " ";
	$query.= $row2['street_adrr'];		
	$query.= "\t";
	$query.= TEXT_TEL;
	$query.= $row2['phone'];		
	$query.= "\t";
	$query.= TEXT_FAX;
	$query.= $row2['fax'];		
        $query.= "\t";      
	$query.= TEXT_EMAIL;
	$query.= $row2['email'];		
        $query.= "\n\n";
	$i++;
}
mail_client( "$mail_admin_address", "Query about bookings from $d1 to $d2", "$query", "$mail_client_from", "$mail_client_reply_to", "$mail_client_x_mailer" );

}

?>
</table>
<? include "themes/footer.php" ?>


