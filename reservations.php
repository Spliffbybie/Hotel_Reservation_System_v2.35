<? 
include "auth.php";
include "themes/header.php"; 

?>

<tr><td valign=top>

<?

  include "themes/menu.php";
  include "functions.php"; 	

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
	
if ($error==1)
   print TEXT_ERROR_ROOM;
if ($error==2)
   print TEXT_ERROR_DATA;
if ($error==3)                     	
   print TEXT_NO_FREE_ROOMS;	  
if ($error==4)                     	
   print TEXT_ERROR_INPUT_ROOMS;	  

if ($spec_id)
{  print TEXT_SPECIAL_OFFER1;
   print $spec_id;
   print TEXT_SPECIAL_OFFER2;	   		                           
   print TEXT_NO_FREE_ROOMS;	  
}


?>

<script language="JavaScript">
function openBrWindow(myUrl) {
	myWin= open(myUrl, "Inventory", 
    "width=450,height=400,status=no,toolbar=no,menubar=no, location=no");
}


</script>


	

<table width="100%" height="100%">
<tr align=left valign=top>
<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=5 color=#cc9900>
<br><b><? print TEXT_CHECK_AVAILABILITY ?></b><p></font>

	<table border=0 width=550 cellpadding=0 cellspacing=0 align=left valign=top>
	<tr align=center valign=top">
	<td>
	<table border=0 align=center>
	<form name="f1" action="rooms.php" method="post">
	<tr align=left>
		<td></td>
		<td><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=2 ><? print TEXT_DD ?></font></td>
		<td><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=2 ><? print TEXT_MM ?></font></td>
		<td><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=2 ><? print TEXT_YYYY ?></font></td>
	</tr>
	<tr align=left>
		<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><B><? print TEXT_ARRIVAL_DATE ?></b></font></td>
		<td><input name="start_day"  size=3 maxlength=2></td>
		<td><input name="start_month"  size=3 maxlength=2></td>
		<td><input name="start_year"  size=5 maxlength=4></td>
	</tr>
	<tr align=left>
		<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><B><? print TEXT_DEPARTURE_DATE ?></B></font></td>
		<td><INPUT NAME="end_day" size="3" MAXLENGTH="2"></td>
		<td><INPUT NAME="end_month" size="3" MAXLENGTH="2"></td>
		<td><INPUT NAME="end_year" size="5" MAXLENGTH="4"></td>
	</tr>
	<tr align=center>
		<td align=left colspan=4><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><? print TEXT_USE_CALENDAR ?></font>
		</td>
	</tr>
	</table>
	<br>
	<hr width=200 color=red>
	<br>
	<table border=0 align=center>
	<tr align=left>
	<td></td>
		 <? $i=1;
		    while ($i<$k)
  	          {?>
		  <td><font face=Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><a href=invent.php  onClick="openBrWindow('invent.php?room=<? print $id[$i] ?>'); return false;"><?  print type($id[$i]) ?> </font></A></td>
		  <? $i++; }?>
	</tr>
	<tr align=center>
		<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><b><? print TEXT_RATE_TODAY ?></b></font><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size="3"><br><CENTER>(<? print $d ?>)</CENTER></font></td>
		 <? $i=1;
		    while ($i<$k)
  	          {?>
		<td><?echo $currency_euro;?><?echo to_euro($rate[$id[$i]]) ?></td>	
		<? $i++; }?>
		
	</tr>
	<tr align=center>
		<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><B><? print TEXT_ROOM_QUANTITY ?></b></font></td>
		 <? $i=1;
		    while ($i<$k)
  	         {?>
		<td><INPUT NAME="<? print $name[$id[$i]] ?>" VALUE="0" size="2" MAXLENGTH="1"></td>
		<? $i++; }?>
	</tr>
	<tr align=center>
		<td align=left><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><b><? print TEXT_MAX_OCCUPANCY ?></b></font></td>
		<? $i=1;
		    while ($i<$k)
		{if ($id[$i]==5)
		   { echo "<td><SELECT NAME='exec_guest_number'><OPTION SELECTED>1<OPTION>2<OPTION>3</SELECT></td>";}
        	else {
		?>
		<td><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><b><? echo $adult[$id[$i]],"+",$child[$id[$i]]; ?></b></font></td>
		<? } $i++; } ?>
		
	</tr>
	<tr align="CENTER">
		<td align="LEFT"><font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3><B><? print TEXT_CHILD ?></B></font></td>
		<td><INPUT  NAME="number_of_child"VALUE="0" size="2" MAXLENGTH="1"></td>
		
	</tr>
</table>

<br>
<HR WIDTH="200" color="RED">
<br>
<input type=hidden name="num" value="<?echo $k;?>">
<input type=submit value="<? print TEXT_CHECK_AVAILABIL ?>">
</form>
</td>
<td>
<?
		include "./calendar_std.php";
		include "./calendar.php";
?>

</td>
</tr>
</table>


</td></tr>
</td><tr></table>
<? include  "themes/footer.php"; ?>
