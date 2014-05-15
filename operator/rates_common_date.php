<? print TEXT_USE_CALENDAR; 


$res = mysql_query("SELECT * FROM Roomtypes where flag='on'");
	$i=1;	
	while( $row = mysql_fetch_array( $res ) ) {
	
		$id[$i]=$row['id'];
		$name[$id[$i]]=$row['name'];
		$i++;
                }
$k=$i;		?>

<br>
<table width="100%"><tr valign="top"><td>
<table>
<form name="f1" action="<?echo $PHP_SELF;?>" method="post">
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
	</table>
</td>
</tr>
<? if( !$DO_NOT_SHOW_ROOMS ) { ?>

<tr><td>
<table>
<tr>
	<? $i=1; 
	while ($i<$k)
	{?>
	 <td><? print type($id[$i]) ?></td>
	 <? $i++; } ?>
	
</tr>
<tr>
	<? $i=1; 
	while ($i<$k)
	{?>
		<td><input size="5" name="<? print $name[$id[$i]] ?>" value=""></td>
	<? $i++; } ?>
</tr>
</table>
</td>
</tr>
<? } ?>