<table cellSpacing=5 width=200 border=0>
 <tr>
    <td  noWrap bgcolor=#442200>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
 	 <tr>
	    <td bgcolor=#ddaa00  nowrap align=center><font color=#ffffff><b><? print TEXT_INFORMATION ?></b></font></td>
	  </tr>
	</table>
</td>
</tr>	
<?
$res=mysql_query("SELECT * FROM Information where name='Main';");
while( $row = mysql_fetch_array( $res ) ) 
{
  if ($index!=1)
{
  echo "<tr><td>&nbsp;&nbsp;<a href=index.php class=menu>",$row['name'],"</a></td></tr>";
}
  $text=$row['body'];
  $title=$row['title'];		

} 

$res=mysql_query("SELECT * FROM Information;");
while( $row = mysql_fetch_array( $res ) ) 
{
	if ($row['name']!='Main')                                   
		echo "<tr><td>&nbsp;&nbsp;<a href=index.php?file=",$row['info_id']," class=menu>", $row['name'], "</a></td></tr>";
}       

?>

<tr>
  <td  noWrap bgcolor=#442200>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
 	 <tr>
	    <td bgcolor=#ddaa00  nowrap align=center><font color=#ffffff><b><? print TEXT_SYSTEM_RESERVATION ?></b></font></td>
	  </tr>
	</table>
</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;<a href="reservations.php" class=menu><? print TEXT_CHECK_RESERVATION ?></a></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;<a href="special_offer.php" class=menu><? print TEXT_SPECIAL_OFFER1 ?></a></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;<a href="corporate/index.php" class=menu><? print TEXT_CORPORATE_PARTNERS ?></a></td>
</tr>
<tr>
    <td>&nbsp</td>
</tr>
 
	
	
</td></tr></table>

 